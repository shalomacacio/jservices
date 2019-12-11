<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\EscalaCreateRequest;
use App\Http\Requests\EscalaUpdateRequest;
use App\Repositories\EscalaRepository;
use App\Validators\EscalaValidator;
use DB;

/**
 * Class EscalasController.
 *
 * @package namespace App\Http\Controllers;
 */
class EscalasController extends Controller
{
    /**
     * @var EscalaRepository
     */
    protected $repository;

    /**
     * @var EscalaValidator
     */
    protected $validator;

    /**
     * EscalasController constructor.
     *
     * @param EscalaRepository $repository
     * @param EscalaValidator $validator
     */
    public function __construct(EscalaRepository $repository, EscalaValidator $validator)
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
        $escalas = $this->repository->all();

        $users = DB::table('users as u')
                      ->join('role_user as ru','u.id','=','ru.user_id')
                      ->where('u.id', '<>' ,1)
                      ->get();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $escalas,
            ]);
        }

        return view('escalas.index', compact('escalas', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  EscalaCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(EscalaCreateRequest $request)
    {
        try {



            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $escala = $this->repository->create($request->all());

            $response = [
                'message' => 'Escala created.',
                'data'    => $escala->toArray(),
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
        $escala = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $escala,
            ]);
        }

        return view('escalas.show', compact('escala'));
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
        $escala = $this->repository->find($id);

        return view('escalas.edit', compact('escala'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  EscalaUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(EscalaUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $escala = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Escala updated.',
                'data'    => $escala->toArray(),
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
                'message' => 'Escala deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Escala deleted.');
    }
}
