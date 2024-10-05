var Repair = function () {
    var Trans = {
        'materi.required': 'Materi harus diisi',
    };

    var handleForm = function () {
        const $form = $('#form-repair');

        $form.off('submit').on('submit', function (e) {
            e.preventDefault();
            Swal.fire({
                text: 'Please wait a moment',
                icon: 'info',
            });

            // Gunakan FormData untuk menangani file upload
            var formData = new FormData(this);

            $.ajax({
                url: $form.attr('action'),
                type: 'post',
                dataType: 'json',
                data: formData,
                processData: false, // Tidak memproses data menjadi string
                contentType: false, // Tidak menetapkan jenis konten
                success: (res) => {
                    Swal.fire({
                        title: res.message || 'Data saved.',
                        icon: 'success',
                    }).then(() => {
                        if(res.redirect) {
                            window.location.href = res.redirect;
                        }
                    });
                },
                error: (e) => {
                    const res = e.responseJSON || {};
                    console.log('status code', e.statusCode())
                    if(res.errors) {
                        const message = Object.values(res.errors)[0] || [];
                        Swal.fire({
                            title: 'Error!',
                            text: message[0],
                            icon: 'error',
                        });
                        console.log(Object.keys(res.errors));
                        for(let key of Object.keys(res.errors)) {
                            const messages = res.errors[key];
                            console.log(key, messages, $('[name="' + key + '"]', $form));
                            $('[name="' + key + '"]', $form).toggleError(true, messages[0])
                        }
                    } else {
                        Swal.fire({
                            title: res.message || 'Unknown Error!',
                            icon: 'error',
                        });
                    }
                },
                complete: () => {},
            });
            return false;
        });
    };

    var handleSelect = function () {
        $('#defect_id').on('change', function() {
            var selectedValue = $(this).val();
            fetchData(selectedValue);
            console.log('Selected value: ' + selectedValue);
        });
    };

    var fetchData = function(defectId) {
        $.ajax({
            url: '/maintenance/fetch-defect',
            type: 'POST',
            data: {
                defect_id: defectId
            },
            success: function(response) {
                $(".masalah").val(response.problem);
                $(".analisa").val(response.analisa);
                console.log(response);
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
            }
        });
    };

    return {
        init: function () {
            $.ajaxSetup({
                headers: {'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')},
                error : function (data) {
                    const resJson = data.responseJSON || {};
                    if(data.status === 422) {
                        var errors = resJson.errors || [];
                        $('.errorTxt1').remove();
                        $.each(errors, function (key, value) {
                            let $inputField = $(':input[name='+ key +']').closest('.input-field'),
                                $html = '<small class="errorTxt1"><div id="'+ key +'-error" class="invalid-feedback">'+ value +'</div></small>';
                            $inputField.append($html);
                        });
                    } else if(resJson.message) {
                        Swal.fire({icon: 'error', text: resJson.message});
                    }
                },
                complete: function () {
                    
                }
            });
        },
        initForm: function () {
            handleForm();
        },
        initSelect: function(){
            handleSelect();
        }
    };
}();

$(document).ready(function(){
    Repair.init();
    Repair.initForm();
    Repair.initSelect();
});
