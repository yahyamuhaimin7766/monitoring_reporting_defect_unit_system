<?php

namespace Scaffolding\Traits;

//use Illuminate\Http\Request;
use Scaffolding\Requests\ScaffoldingRequest as Request;
use Illuminate\Support\Str;

trait ScaffoldingTrait
{
    use ScaffoldingInit;

    public function setConfig($config = [])
    {
        $this->scaffolding()->setConfig($config);
    }

    public function index()
    {
        /** @var \Scaffolding\Models\InitModel $model */
        /** @var string $prefix */
        extract($this->scaffolding()->parameters());
        $datatableConfig = $this->scaffolding()->datatable();
        $breadcrumbs = $datatableConfig['viewBreadcrumbs'] ?: [
            ['link' => url('/'), 'name' => "Home"],
            ['name' => Str::title($title ?? $prefix)],
            ['name' => "List"],
        ];
        $pageConfigs = ['pageHeader' => true, 'isFabButton' => false, 'toolbar' => $this->scaffolding()->datatable('viewToolbar')];
        if (request()->ajax()) {
            try {
//                /** @var \Yajra\DataTables\EloquentDataTable $datatable */
                $datatable = \DataTables::eloquent($datatableConfig['withQuery'] ?: $model->newQuery());
                $datatable->addColumn('action', function ($model) {
                    return $this->scaffolding()->getActionButtons($model, true);
                })->escapeColumns(false);
                foreach ($this->scaffolding()->datatableColumns() as $column => $attributes) {
                    if(isset($attributes['formatter']) && $attributes['formatter'] instanceof \Closure) {
                        $datatable->editColumn($column, $attributes['formatter']);
                    }
                    if(isset($attributes['filter']) && $attributes['filter'] instanceof \Closure) {
                        $datatable->filterColumn($column, $attributes['filter']);
                    }
                }
                if ($datatableConfig['filter']) {
                    $datatable->filter($datatableConfig['filter']);
                }
                return $datatable->toJson();
            } catch (\Exception $e) {
                dd($e);
            }
        }
        $title = $datatableConfig['viewTitle'] ?: Str::title($title ?? $prefix);
        return view('scaffolding::index', get_defined_vars());
    }

    public function create(Request $request)
    {
        try {
            call_user_func($this->scaffolding()->hooks('onCreate'));
            if ($request->isMethod('put')) return $this->save($request);
            extract($this->scaffolding()->parameters());
            /** @var \Scaffolding\Models\InitModel $model */
            $action = $model->id ? 'Edit' : 'Add';
            /** @var string $prefix */
            $breadcrumbs = [
                ['link' => url('/'), 'name' => "Home"],
                ['link' => url($url ?? $prefix), 'name' => Str::title($title ?? $prefix)],
                ['name' => $action],
            ];
            $title = "$action " . Str::title($title ?? $prefix);
            $pageConfigs = ['pageHeader' => true, 'isFabButton' => false];
            call_user_func_array($this->scaffolding()->hooks('onCreated'), [$model]);
            return view('scaffolding::form', get_defined_vars());
        } catch (\Exception $e) {
            dd($e);
        }
    }

    public function edit(Request $request, $id)
    {
        try {
            if($id instanceof \Illuminate\Database\Eloquent\Model) {
                $model = $id;
            } else {
                $model = $this->scaffolding()->getModel();
                $model = $model->findOrFail($id);
            }
            $this->setConfig([
                'model' => $model,
            ]);
            call_user_func_array($this->scaffolding()->hooks('onEdit'), [$model]);
            if ($request->isMethod('patch')) return $this->save($request);
            extract($this->scaffolding()->parameters());
            $action = $model->id ? 'Edit' : 'Add';
            /** @var string $prefix */
            $breadcrumbs = [
                ['link' => url('/'), 'name' => "Home"],
                ['link' => url($url ?? $prefix), 'name' => Str::title($title ?? $prefix)],
                ['name' => $action],
            ];
            $pageConfigs = ['pageHeader' => true, 'isFabButton' => false];
            $title = "$action " . Str::title($title ?? $prefix);
            call_user_func_array($this->scaffolding()->hooks('onEdited'), [$model]);
            return view('scaffolding::form', get_defined_vars());
        } catch (\Exception $e) {
            dd($e);
        }

    }

    public function view(Request $request, $id)
    {
        if($id instanceof \Illuminate\Database\Eloquent\Model) {
            $model = $id;
        } else {
            $model = $this->scaffolding()->getModel();
            $model = $model->findOrFail($id);
        }
        $this->setConfig([
            'model' => $model,
        ]);
        call_user_func_array($this->scaffolding()->hooks('onEdit'), [$model]);
        extract($this->scaffolding()->parameters());
        $action = 'View';
        /** @var string $prefix */
        $breadcrumbs = [
            ['link' => url('/'), 'name' => "Home"],
            ['link' => url($url ?? $prefix), 'name' => Str::title($title ?? $prefix)],
            ['name' => $action],
        ];
        $pageConfigs = ['pageHeader' => true, 'isFabButton' => false];
        $title = "$action " . Str::title($title ?? $prefix);
        call_user_func_array($this->scaffolding()->hooks('onEdited'), [$model]);
        return view('scaffolding::form', get_defined_vars());

    }

    public function save(Request $request)
    {
        $model = $this->scaffolding()->getModel();
        $prefix = $this->scaffolding()->prefix();
        try {
            \DB::beginTransaction();
            $model->fill($request->all());
            call_user_func_array($this->scaffolding()->hooks('onSave'), [$model]);
            $model->save();
            call_user_func_array($this->scaffolding()->hooks('onSaved'), [$model]);
            \DB::commit();
            return $this->scaffolding()->redirectTo(route("$prefix.index"), ['success' => 'Data saved!']);
        } catch (\Exception $e) {
            dd($e);
        }
    }

    public function destroy($id)
    {
        $model = $this->scaffolding()->getModel();
        $model = $model->findOrFail($id);
        $prefix = $this->scaffolding()->prefix();
        try {
            \DB::beginTransaction();
            call_user_func_array($this->scaffolding()->hooks('onDelete'), [$model]);
            $model->delete();
            call_user_func_array($this->scaffolding()->hooks('onDeleted'), [$model]);
            \DB::commit();
            return $this->scaffolding()->redirectTo($prefix, ['success' => 'Data deleted!']);
        } catch (\Exception $e) {
            dd($e);
        }
    }
}
