<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\RestRequest;
use App\Models\Rest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class RestController extends Controller
{
    /**
     * @var array
     */
    protected $breadcrumbs;

    /**
     * RestController constructor.
     */
    public function __construct()
    {
        $this->breadcrumbs = [
            route('admin.rests.index') => __('global.titles.rests_index'),
        ];
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        /** @var Rest $rests */
        $rests = Rest::orderBy('id', 'ASC');

        if ($param = $request->search) {
            $rests->where('id', 'LIKE', "%{$param}%");
        }

        return view('admin.rests.index', [
            'rests' => $rests->paginate(20)
        ]);
    }

    /**
     * @param RestRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function create(RestRequest $request)
    {
        if ($request->isMethod('post')) {
            DB::beginTransaction();
            try {
                /** @var Rest $rest */
                $rest = Rest::create($request->all());
                DB::commit();
                messages(__('global.titles.success'), __('messages.success_store'), 'success');
                return redirect()->route('admin.rests.index');
            } catch (\Exception $exception) {
                DB::rollBack();
                messages(__('global.titles.danger'), __('messages.error_store'), 'danger', 5000);
                return redirect()->back();
            }
        }

        return view('admin.rests.create', [
            'breadcrumbs' => $this->breadcrumbs,
        ]);
    }

    /**
     * @param $id
     * @param RestRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function edit($id, RestRequest $request)
    {
        /** @var Rest $rest */
        $rest = Rest::find($id);
        if ($request->isMethod('post')) {
            DB::beginTransaction();
            try {
                $rest->update($request->all());
                DB::commit();
                messages(__('global.titles.success'), __('messages.success_update'), 'success');
                return redirect()->route('admin.rests.index');
            } catch (\Exception $exception) {
                DB::rollBack();
                messages(__('global.titles.danger'), __('messages.error_update'), 'danger', 5000);
                return redirect()->route('admin.rests.edit', $id);
            }
        }

        return view('admin.rests.edit', [
            'rest' => $rest,
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
            Rest::find($id)->delete();
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
        $rests = Rest::orderBy('deleted_at', 'DESC')->onlyTrashed();

        if ($param = $request->search) {
            $rests->where('id', 'LIKE', "%{$param}%");
        }

        return view('admin.rests.trashed', [
            'rests' => $rests->paginate(20)
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
            /** @var Rest $rest */
            $rest = Rest::where('id', $id)->onlyTrashed()->first();
            $rest->restore();
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
            /** @var Rest $rest */
            $rest = Rest::where('id', $id)->onlyTrashed()->first();
            $rest->forceDelete();
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
