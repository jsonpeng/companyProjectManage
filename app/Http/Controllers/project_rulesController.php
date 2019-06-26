<?php

namespace App\Http\Controllers;

use App\Http\Requests\Createproject_rulesRequest;
use App\Http\Requests\Updateproject_rulesRequest;
use App\Repositories\project_rulesRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class project_rulesController extends AppBaseController
{
    /** @var  project_rulesRepository */
    private $projectRulesRepository;

    public function __construct(project_rulesRepository $projectRulesRepo)
    {
        $this->projectRulesRepository = $projectRulesRepo;
    }

    /**
     * Display a listing of the project_rules.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->projectRulesRepository->pushCriteria(new RequestCriteria($request));
        $projectRules = $this->projectRulesRepository->all();

        return view('project_rules.index')
            ->with('projectRules', $projectRules);
    }

    /**
     * Show the form for creating a new project_rules.
     *
     * @return Response
     */
    public function create()
    {
        return view('project_rules.create');
    }

    /**
     * Store a newly created project_rules in storage.
     *
     * @param Createproject_rulesRequest $request
     *
     * @return Response
     */
    public function store(Createproject_rulesRequest $request)
    {
        $input = $request->all();

        $projectRules = $this->projectRulesRepository->create($input);

        Flash::success('Project Rules saved successfully.');

        return redirect(route('projectRules.index'));
    }

    /**
     * Display the specified project_rules.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $projectRules = $this->projectRulesRepository->findWithoutFail($id);

        if (empty($projectRules)) {
            Flash::error('Project Rules not found');

            return redirect(route('projectRules.index'));
        }

        return view('project_rules.show')->with('projectRules', $projectRules);
    }

    /**
     * Show the form for editing the specified project_rules.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $projectRules = $this->projectRulesRepository->findWithoutFail($id);

        if (empty($projectRules)) {
            $this->projectRulesRepository->create([
                'basic_cost'=>1000,
                'first_price'=>5000,
               'first_prop'=>0.2,
               'second_prop'=>0.4
           ]);
            return redirect(route('projectRules.edit', [1]));
        }

        return view('project_rules.edit')->with('projectRules', $projectRules);
    }

    /**
     * Update the specified project_rules in storage.
     *
     * @param  int              $id
     * @param Updateproject_rulesRequest $request
     *
     * @return Response
     */
    public function update($id, Updateproject_rulesRequest $request)
    {
        $projectRules = $this->projectRulesRepository->findWithoutFail($id);

        if (empty($projectRules)) {
            Flash::error('Project Rules not found');

            return redirect(route('projectRules.index'));
        }

        $projectRules = $this->projectRulesRepository->update($request->all(), $id);

        Flash::success('项目规则更新成功.');
        return redirect(route('projectRules.edit', [1]));
        //return redirect(route('projectRules.index'));
    }

    /**
     * Remove the specified project_rules from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $projectRules = $this->projectRulesRepository->findWithoutFail($id);

        if (empty($projectRules)) {
            Flash::error('Project Rules not found');

            return redirect(route('projectRules.index'));
        }

        $this->projectRulesRepository->delete($id);

        Flash::success('Project Rules deleted successfully.');

        return redirect(route('projectRules.index'));
    }
}
