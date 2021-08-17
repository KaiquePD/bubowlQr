<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\FoodsRequest;
use App\Models\Foods;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class FoodsController extends Controller
{
    /**
     * @var array
     */
    protected $breadcrumbs;

    /**
     * FoodsController constructor.
     */
    public function __construct()
    {
        $this->breadcrumbs = [
            route('admin.foods.index') => __('global.titles.foods_index'),
        ];
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        /** @var Foods $foods */
        $foods = Foods::orderBy('id', 'ASC');

        if ($param = $request->search) {
            $foods->where('id', 'LIKE', "%{$param}%");
        }

        return view('admin.foods.index', [
            'foods' => $foods->paginate(20)
        ]);
    }

    /**
     * @param FoodsRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function create(FoodsRequest $request)
    {
        if ($request->isMethod('post')) {
            DB::beginTransaction();
            try {
                /** @var Foods $foods */
                $foods = Foods::create($request->all());
                DB::commit();
                messages(__('global.titles.success'), __('messages.success_store'), 'success');
                return redirect()->route('admin.foods.index');
            } catch (\Exception $exception) {
                DB::rollBack();
                messages(__('global.titles.danger'), __('messages.error_store'), 'danger', 5000);
                return redirect()->back();
            }
        }

        return view('admin.foods.create', [
            'breadcrumbs' => $this->breadcrumbs,
        ]);
    }

    /**
     * @param $id
     * @param FoodsRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function edit($id, FoodsRequest $request)
    {
        /** @var Foods $foods */
        $foods = Foods::find($id);
        if ($request->isMethod('post')) {
            DB::beginTransaction();
            try {
                $foods->update($request->all());
                DB::commit();
                messages(__('global.titles.success'), __('messages.success_update'), 'success');
                return redirect()->route('admin.foods.index');
            } catch (\Exception $exception) {
                DB::rollBack();
                messages(__('global.titles.danger'), __('messages.error_update'), 'danger', 5000);
                return redirect()->route('admin.foods.edit', $id);
            }
        }

        return view('admin.foods.edit', [
            'foods' => $foods,
            'breadcrumbs' => $this->breadcrumbs,
        ]);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            Foods::find($id)->delete();
            DB::commit();
            messages(__('global.titles.success'), __('messages.success_trashed'), 'success', 6000);
            return redirect()->back();
        } catch (\Exception $exception) {
            DB::rollBack();
            messages(__('global.titles.danger'), __('messages.error_trashed'), 'danger', 6000);
            return redirect()->back();
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function trashed(Request $request)
    {
        $foods = Foods::orderBy('deleted_at', 'DESC')->onlyTrashed();

        if ($param = $request->search) {
            $foods->where('id', 'LIKE', "%{$param}%");
        }

        return view('admin.foods.trashed', [
            'foods' => $foods->paginate(20)
        ]);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore($id)
    {
        DB::beginTransaction();
        try {
            /** @var Foods $foods */
            $foods = Foods::where('id', $id)->onlyTrashed()->first();
            $foods->restore();
            DB::commit();
            messages(__('global.titles.success'), __('messages.success_restore'), 'success');
            return redirect()->back();
        } catch (\Exception $exception) {
            DB::rollBack();
            messages(__('global.titles.danger'), __('messages.error_retore'), 'danger');
            return redirect()->back();
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function forceDelete($id)
    {
        DB::beginTransaction();
        try {
            /** @var Foods $foods */
            $foods = Foods::where('id', $id)->onlyTrashed()->first();
            $foods->forceDelete();
            DB::commit();
            messages(__('global.titles.success'), __('messages.success_destroy'), 'success');
            return redirect()->back();
        } catch (\Exception $exception) {
            DB::rollBack();
            messages(__('global.titles.danger'), __('messages.error_destroy'), 'danger');
            return redirect()->back();
        }
    }
}
