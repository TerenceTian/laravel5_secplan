<?php namespace App\Http\Controllers;

use App\Http\Requests;

use App\Http\Requests\CreateItemsRequest;
use Chromabits\Purifier\Contracts\Purifier;
use Repositories\Api\IItemRepository;

class ItemsController extends Controller {

	public function __construct(IItemRepository $item, Purifier $purifier) {

		$this->item = $item;
		$this->purifier = $purifier;

		$this->middleware('auth', ['only' => ['create', 'store', 'edit', 'update', 'destroy']]);
		$this->middleware('manager', ['only' => ['edit', 'update', 'destroy']]);

	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$items = $this->item->getAllItems();

		return view('items.index', compact('items'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('items.create_edit');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param CreateItemsRequest $request
	 * @return Response
	 */
	public function store(CreateItemsRequest $request)
	{
		$data = $request->all();
		$data['shop_id'] = 4;
		$data['geo_id'] = 1;
		$data['amount'] = 1;
		$data['original_price'] = 1;
		$data['post_price'] = 1;
		$data['phone_number'] = 111;
		$data['address'] = 'abc';
		//dd($data);
		$data = $this->purifier->clean($data);
		$item = $this->item->createOrUpdate($data);

		return redirect()->route('items.show', $item->id);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$item = $this->item->getItemById($id);

		return view('items.show', compact('item'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$item = $this->item->getItemById($id);
		$this->RedirectIfNotOwner($item->shop->user_id);

		return view('items.create_edit');
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int $id
	 * @param CreateItemsRequest $request
	 * @return Response
	 */
	public function update($id, CreateItemsRequest $request)
	{
		$data = $request->all();
		$item = $this->item->getItemById($id);
		$this->RedirectIfNotOwner($item->shop->user_id);

		$data = $this->purifier->clean($data);

		$this->item->createOrUpdate($data, $id);

		return redirect()->route('items.show', $id);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$item  = $this->item->getItemById($id);
		$this->RedirectIfNotOwner($item->shop->user_id);

		$this->item->destroy($id);

		return redirect()->route('items.index');
	}

}
