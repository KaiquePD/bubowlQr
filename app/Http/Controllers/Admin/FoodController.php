<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\FoodRequest;
use App\Models\Food;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class FoodController extends Controller
{
    /**
     * @var array
     */
    protected $breadcrumbs;

    /**
     * FoodController constructor.
     */
    public function __construct()
    {
        $this->breadcrumbs = [
            route('admin.food.index') => __('global.titles.food_index'),
        ];
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        /** @var Food $food */
        $food = Food::orderBy('id', 'ASC');

        if ($param = $request->search) {
            $food->where('id', 'LIKE', "%{$param}%");
        }

        return view('admin.food.index', [
            'food' => $food->paginate(20)
        ]);
    }

    /**
     * @param FoodRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function create(FoodRequest $request)
    {
        if ($request->isMethod('post')) {
            DB::beginTransaction();
            try {
                /** @var Food $food */
                $food = Food::create($request->all());
                DB::commit();
                messages(__('global.titles.success'), __('messages.success_store'), 'success');
                return redirect()->route('admin.food.index');
            } catch (\Exception $exception) {
                DB::rollBack();
                messages(__('global.titles.danger'), __('messages.error_store'), 'danger', 5000);
                return redirect()->back();
            }
        }

        return view('admin.food.create', [
            'breadcrumbs' => $this->breadcrumbs,
        ]);
    }

    /**
     * @param $id
     * @param FoodRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function edit($id, FoodRequest $request)
    {
        /** @var Food $food */
        $food = Food::find($id);
        if ($request->isMethod('post')) {
            DB::beginTransaction();
            try {
                $food->update($request->all());
                DB::commit();
                messages(__('global.titles.success'), __('messages.success_update'), 'success');
                return redirect()->route('admin.food.index');
            } catch (\Exception $exception) {
                DB::rollBack();
                messages(__('global.titles.danger'), __('messages.error_update'), 'danger', 5000);
                return redirect()->route('admin.food.edit', $id);
            }
        }

        return view('admin.food.edit', [
            'food' => $food,
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
            Food::find($id)->delete();
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
        $food = Food::orderBy('deleted_at', 'DESC')->onlyTrashed();

        if ($param = $request->search) {
            $food->where('id', 'LIKE', "%{$param}%");
        }

        return view('admin.food.trashed', [
            'food' => $food->paginate(20)
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
            /** @var Food $food */
            $food = Food::where('id', $id)->onlyTrashed()->first();
            $food->restore();
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
            /** @var Food $food */
            $food = Food::where('id', $id)->onlyTrashed()->first();
            $food->forceDelete();
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
