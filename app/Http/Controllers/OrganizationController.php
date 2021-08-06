<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Organization;
use App\Services\App\Sistema\OrganizationService;

class OrganizationController extends Controller
{

    public function __construct(OrganizationService $orgService)
    {
        $this->orgService = $orgService;
    }

    public function view()
    {
        return view('masterdata::index');
    }

    public function index(Request $request)
    {
        return $this->orgService
            ->paginate(request()->get('per_page', 10));
    }


    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $this->orgService->save();

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw new Exception($th->getMessage());
        }

        return created_responses('data');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {

        return $this->orgService->find($id);
    }

    public function get_id($id)
    {
        $bank = $this->orgService->where('id', $id)->get();
    }


    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, Organization $org)
    {
        $org = $this->orgService->update($org);
        return updated_responses('data');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Organization $org)
    {
        if ($this->orgService->delete($org)) {

            return deleted_responses('data');
        }
        return failed_responses();
    }
}
