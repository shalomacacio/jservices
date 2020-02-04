<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\MkAtendimentoCreateRequest;
use App\Http\Requests\MkAtendimentoUpdateRequest;
use App\Repositories\MkAtendimentoRepository;
use App\Validators\MkAtendimentoValidator;
use Carbon\Carbon;

/**
 * Class MkAtendimentosController.
 *
 * @package namespace App\Http\Controllers;
 */
class MkAtendimentosController extends Controller
{
    /**
     * @var MkAtendimentoRepository
     */
    protected $repository;

    /**
     * @var MkAtendimentoValidator
     */
    protected $validator;

    /**
     * MkAtendimentosController constructor.
     *
     * @param MkAtendimentoRepository $repository
     * @param MkAtendimentoValidator $validator
     */
    public function __construct(MkAtendimentoRepository $repository, MkAtendimentoValidator $validator)
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
      $dtInicio = Carbon::now()->format('Y-m-d 00:00:00');

        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $mkAtendimentos = $this->repository->scopeQuery(function ($query) use($dtInicio) {
          return $query
            ->whereDate('dt_abertura', '>=', $dtInicio)
            // ->whereIn('cd_processo', [18,35,37,44,48,49,50,52,54,55,57,59,])
            ->whereIn('cd_processo', [53])
            ->orderBy('cd_processo', 'desc');
        })->paginate(50);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $mkAtendimentos,
            ]);
        }

        // return $mkAtendimentos;
        return view('atendimentos.index', compact('mkAtendimentos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  MkAtendimentoCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(MkAtendimentoCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $mkAtendimento = $this->repository->create($request->all());

            $response = [
                'message' => 'MkAtendimento created.',
                'data'    => $mkAtendimento->toArray(),
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
        $mkAtendimento = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $mkAtendimento,
            ]);
        }

        return view('mkAtendimentos.show', compact('mkAtendimento'));
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
        $mkAtendimento = $this->repository->find($id);

        return view('mkAtendimentos.edit', compact('mkAtendimento'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  MkAtendimentoUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(MkAtendimentoUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $mkAtendimento = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'MkAtendimento updated.',
                'data'    => $mkAtendimento->toArray(),
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
                'message' => 'MkAtendimento deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'MkAtendimento deleted.');
    }
}
