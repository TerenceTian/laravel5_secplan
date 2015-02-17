<?php namespace App\Http\Controllers;

use App\Http\Requests;

use App\Http\Requests\ShopsFormRequest;
use App\Repositories\Api\IShopRepository;
use App\Shop;
use Chromabits\Purifier\Contracts\Purifier;

class ShopsController extends Controller
{

    public function __construct(IShopRepository $shop, Purifier $purifier) {

        $this->shop = $shop;
        $this->purifier = $purifier;

        $this->middleware('auth', ['only' => ['create', 'store', 'edit', 'update', 'destroy']]);
        $this->middleware('manager', ['only' => ['create', 'store', 'edit', 'update', 'destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        $shops = $this->shop->getAllShops();

        return view('shops.index', compact('shops'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        return view('shops.create_edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ShopsFormRequest $request
     * @return Response
     */
    public function store(ShopsFormRequest $request) {
        $data = $request->all();
        $data = $this->purifier->clean($data);
        $shop = $this->shop->createOrUpdate($data);

        return redirect()->route('shops.show', $shop->id);
    }

    /**
     * Display the specified resource.
     *
     * @param Shop $shop
     * @return Response
     */
    public function show(Shop $shop) {
        $items = $this->shop->getItemsInShop($shop);

        return view('shops.show', compact('shop', 'items'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param ShopsFormRequest $request
     * @param Shop $shop
     * @return Response
     */
    public function edit(ShopsFormRequest $request, Shop $shop) {

        return view('shops.create_edit', compact('shop'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Shop $shop
     * @param ShopsFormRequest $request
     * @return Response
     */
    public function update(Shop $shop, ShopsFormRequest $request) {
        $data = $request->all();

        $data = $this->purifier->clean($data);
        $this->shop->createOrUpdate($data, $shop);

        return redirect()->route('shops.show', $shop->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ShopsFormRequest $request
     * @param Shop $shop
     * @return Response
     */
    public function destroy(ShopsFormRequest $request, Shop $shop) {
        $this->shop->destroy($shop);

        return redirect()->route('shops.index');
    }

}
