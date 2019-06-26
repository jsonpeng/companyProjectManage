<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateproductcatsRequest;
use App\Http\Requests\UpdateproductcatsRequest;
use App\Repositories\productcatsRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class productcatsController extends AppBaseController
{
    /** @var  productcatsRepository */
    private $productcatsRepository;

    public function __construct(productcatsRepository $productcatsRepo)
    {
        $this->productcatsRepository = $productcatsRepo;
    }

    /**
     * Display a listing of the productcats.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->productcatsRepository->pushCriteria(new RequestCriteria($request));
        $productcats = $this->productcatsRepository->all();

        return view('productcats.index')
            ->with('productcats', $productcats);
    }

    /**
     * Show the form for creating a new productcats.
     *
     * @return Response
     */
    public function create()
    {
        return view('productcats.create');
    }

    /**
     * Store a newly created productcats in storage.
     *
     * @param CreateproductcatsRequest $request
     *
     * @return Response
     */
    public function store(CreateproductcatsRequest $request)
    {
        $input = $request->all();

        $productcats = $this->productcatsRepository->create($input);

        Flash::success('产品分类创建成功.');

        return redirect(route('productcats.index'));
    }

    /**
     * Display the specified productcats.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $productcats = $this->productcatsRepository->findWithoutFail($id);

        if (empty($productcats)) {
            Flash::error('Productcats not found');

            return redirect(route('productcats.index'));
        }

        return view('productcats.show')->with('productcats', $productcats);
    }

    /**
     * Show the form for editing the specified productcats.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $productcats = $this->productcatsRepository->findWithoutFail($id);

        if (empty($productcats)) {
            Flash::error('Productcats not found');

            return redirect(route('productcats.index'));
        }

        return view('productcats.edit')->with('productcats', $productcats);
    }

    /**
     * Update the specified productcats in storage.
     *
     * @param  int              $id
     * @param UpdateproductcatsRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateproductcatsRequest $request)
    {
        $productcats = $this->productcatsRepository->findWithoutFail($id);

        if (empty($productcats)) {
            Flash::error('Productcats not found');

            return redirect(route('productcats.index'));
        }

        $productcats = $this->productcatsRepository->update($request->all(), $id);

        Flash::success('产品分类更新成功.');

        return redirect(route('productcats.index'));
    }

    /**
     * Remove the specified productcats from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $productcats = $this->productcatsRepository->findWithoutFail($id);

        if (empty($productcats)) {
            Flash::error('Productcats not found');

            return redirect(route('productcats.index'));
        }

        $this->productcatsRepository->delete($id);

        Flash::success('Productcats deleted successfully.');

        return redirect(route('productcats.index'));
    }
}
