<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\MkBairroCreateRequest;
use App\Http\Requests\MkBairroUpdateRequest;
use App\Repositories\MkBairroRepository;
use App\Validators\MkBairroValidator;

/**
 * Class MkBairrosController.
 *
 * @package namespace App\Http\Controllers;
 */
class MkBairrosController extends Controller
{
    /**
     * @var MkBairroRepository
     */
    protected $repository;

    /**
     * @var MkBairroValidator
     */
    protected $validator;

    /**
     * MkBairrosController constructor.
     *
     * @param MkBairroRepository $repository
     * @param MkBairroValidator $validator
     */
    public function __construct(MkBairroRepository $repository, MkBairroValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $mkBairros = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $mkBairros,
            ]);
        }

        return view('mkBairros.index', compact('mkBairros'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  MkBairroCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(MkBairroCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $mkBairro = $this->repository->create($request->all());

            $response = [
                'message' => 'MkBairro created.',
                'data'    => $mkBairro->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $mkBairro = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $mkBairro,
            ]);
        }

        return view('mkBairros.show', compact('mkBairro'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $mkBairro = $this->repository->find($id);

        return view('mkBairros.edit', compact('mkBairro'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  MkBairroUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(MkBairroUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $mkBairro = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'MkBairro updated.',
                'data'    => $mkBairro->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {

            if ($request->wantsJson()) {

                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = $this->repository->delete($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'MkBairro deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'MkBairro deleted.');
    }
}
