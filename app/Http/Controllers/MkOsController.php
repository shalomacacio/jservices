<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\MkOsCreateRequest;
use App\Http\Requests\MkOsUpdateRequest;
use App\Repositories\MkOsRepository;
use App\Validators\MkOsValidator;
use App\Entities\MkOs;
use Carbon\Carbon;

/**
 * Class MkOsController.
 *
 * @package namespace App\Http\Controllers;
 */
class MkOsController extends Controller
{
    /**
     * @var MkOsRepository
     */
    protected $repository;

    /**
     * @var MkOsValidator
     */
    protected $validator;

    /**
     * MkOsController constructor.
     *
     * @param MkOsRepository $repository
     * @param MkOsValidator $validator
     */
    public function __construct(MkOsRepository $repository, MkOsValidator $validator)
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
        $mkOs = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $mkOs,
            ]);
        }

        return view('mkOs.index', compact('mkOs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  MkOsCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(MkOsCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $mkO = $this->repository->create($request->all());

            $response = [
                'message' => 'MkOs created.',
                'data'    => $mkO->toArray(),
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
        $mkO = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $mkO,
            ]);
        }

        return view('mkOs.show', compact('mkO'));
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
        $mkO = $this->repository->find($id);

        return view('mkOs.edit', compact('mkO'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  MkOsUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(MkOsUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $mkO = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'MkOs updated.',
                'data'    => $mkO->toArray(),
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

    public function agenda(Request $request){
      $data = Carbon::now()->format('Y-m-d');

      if($request->dt_escala){
        $data = $request->dt_escala;
      }

      // Tipos de OS
      $tipos = [2,5,6,111,133,138];
      $result = MkOs::where('data_abertura', $data)
                      //  ->whereIn('tipo_os', $tipos)
                       ->orderBy('data_abertura', 'asc')
                       ->get();

      $ordens = $result;
      $aberto = $result->where('status', 1)->count();
      $encaminhado = $result->where('status', 2)->count();
      $concluido = $result->where('status', 3)->count();

      $porAtend = $result->groupBy('mkPessoa.nome_razaosocial');
      $porServ = 0;
      $porTec = 0;

      return view('agenda.index', compact('ordens', 'aberto','encaminhado' , 'concluido', 'porAtend', 'porServ', 'porTec', 'data'));


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
                'message' => 'MkOs deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'MkOs deleted.');
    }
}
