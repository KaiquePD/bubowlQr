<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\SegmentRequest;
use App\Models\Segment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class SegmentController extends Controller
{
    /**
     * @var array
     */
    protected $breadcrumbs;

    /**
     * SegmentController constructor.
     */
    public function __construct()
    {
        $this->breadcrumbs = [
            route('admin.segments.index') => __('global.titles.segments_index'),
        ];
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        /** @var Segment $segments */
        $segments = Segment::orderBy('id', 'ASC');

        if ($param = $request->search) {
            $segments->where('id', 'LIKE', "%{$param}%");
        }

        return view('admin.segments.index', [
            'segments' => $segments->paginate(20)
        ]);
    }

    /**
     * @param SegmentRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function create(SegmentRequest $request)
    {
        if ($request->isMethod('post')) {
            DB::beginTransaction();
            try {
                /** @var Segment $segment */
                $segment = Segment::create($request->all());
                DB::commit();
                messages(__('global.titles.success'), __('messages.success_store'), 'success');
                return redirect()->route('admin.segments.index');
            } catch (\Exception $exception) {
                DB::rollBack();
                messages(__('global.titles.danger'), __('messages.error_store'), 'danger', 5000);
                return redirect()->back();
            }
        }

        return view('admin.segments.create', [
            'breadcrumbs' => $this->breadcrumbs,
        ]);
    }

    /**
     * @param $id
     * @param SegmentRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function edit($id, SegmentRequest $request)
    {
        /** @var Segment $segment */
        $segment = Segment::find($id);
        if ($request->isMethod('post')) {
            DB::beginTransaction();
            try {
                $segment->update($request->all());
                DB::commit();
                messages(__('global.titles.success'), __('messages.success_update'), 'success');
                return redirect()->route('admin.segments.index');
            } catch (\Exception $exception) {
                DB::rollBack();
                messages(__('global.titles.danger'), __('messages.error_update'), 'danger', 5000);
                return redirect()->route('admin.segments.edit', $id);
            }
        }

        return view('admin.segments.edit', [
            'segment' => $segment,
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
            Segment::find($id)->delete();
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
        $segments = Segment::orderBy('deleted_at', 'DESC')->onlyTrashed();

        if ($param = $request->search) {
            $segments->where('id', 'LIKE', "%{$param}%");
        }

        return view('admin.segments.trashed', [
            'segments' => $segments->paginate(20)
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
            /** @var Segment $segment */
            $segment = Segment::where('id', $id)->onlyTrashed()->first();
            $segment->restore();
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
            /** @var Segment $segment */
            $segment = Segment::where('id', $id)->onlyTrashed()->first();
            $segment->forceDelete();
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
