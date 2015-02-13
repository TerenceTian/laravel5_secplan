<?php namespace App\Http\Controllers;

use App\Http\Requests;

use App\Http\Requests\CreateShopsRequest;
use Chromabits\Purifier\Contracts\Purifier;
use Repositories\Api\IShopRepository;
use Auth;

class ShopsController extends Controller
{

    public function __construct(IShopRepository $shop, Purifier $purifier) {

        $this->shop = $shop;
        $this->purifier = $purifier;

        $this->middleware('auth', ['only' => ['create', 'store', 'edit', 'update', 'destroy']]);
        $this->middleware('manager', ['only' => ['edit', 'update', 'destroy']]);
    }

    public function RedirectIfNotOwner($id) {
        if ($id == Auth::user()->id) {
            return true;
        }

        return abort(403, '没有权限');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        $shops = $this->shop->getAllShops();

        return View('shops.index', compact('shops'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        return View('shops.create_edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateShopsRequest $request
     * @return Response
     */
    public function store(CreateShopsRequest $request) {
        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        $data = $this->purifier->clean($data);
        $shop = $this->shop->createOrUpdate($data);

        return redirect()->route('shops.show', $shop->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id) {
        $shop = $this->shop->getShopById($id);

        return View('shops.show', compact('shop'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id) {
        $this->RedirectIfNotOwner($id);

        $shop = $this->shop->getShopById($id);

        return View('shops.create_edit', compact('shop'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @param CreateShopsRequest $request
     * @return Response
     */
    public function update($id, CreateShopsRequest $request) {
        $this->RedirectIfNotOwner($id);

        $data = $request->all();
        //$data['user_id'] = Auth::user()->id;
        $data = $this->purifier->clean($data);
        $this->shop->createOrUpdate($data, $id);

        return redirect()->route('shops.show', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id) {
        $this->RedirectIfNotOwner($id);

        $this->shop->destroy($id);

        return redirect()->route('shops.index');
    }

}
