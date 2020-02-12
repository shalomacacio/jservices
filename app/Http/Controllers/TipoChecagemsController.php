<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\TipoChecagemCreateRequest;
use App\Http\Requests\TipoChecagemUpdateRequest;
use App\Repositories\TipoChecagemRepository;
use App\Validators\TipoChecagemValidator;

/**
 * Class TipoChecagemsController.
 *
 * @package namespace App\Http\Controllers;
 */
class TipoChecagemsController extends Controller
{
    /**
     * @var TipoChecagemRepository
     */
    protected $repository;

    /**
     * @var TipoChecagemValidator
     */
    protected $validator;

    /**
     * TipoChecagemsController constructor.
     *
     * @param TipoChecagemRepository $repository
     * @param TipoChecagemValidator $validator
     */
    public function __construct(TipoChecagemRepository $repository, TipoChecagemValidator $validator)
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
        $tipoChecagems = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $tipoChecagems,
            ]);
        }

        return view('tipoChecagems.index', compact('tipoChecagems'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  TipoChecagemCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(TipoChecagemCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $tipoChecagem = $this->repository->create($request->all());

            $response = [
                'message' => 'TipoChecagem created.',
                'data'    => $tipoChecagem->toArray(),
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
        $tipoChecagem = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $tipoChecagem,
            ]);
        }

        return view('tipoChecagems.show', compact('tipoChecagem'));
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
        $tipoChecagem = $this->repository->find($id);

        return view('tipoChecagems.edit', compact('tipoChecagem'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  TipoChecagemUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(TipoChecagemUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $tipoChecagem = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'TipoChecagem updated.',
                'data'    => $tipoChecagem->toArray(),
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
                'message' => 'TipoChecagem deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'TipoChecagem deleted.');
    }
}
