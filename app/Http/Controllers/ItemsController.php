<?php namespace App\Http\Controllers;

use App\Http\Requests;

use App\Http\Requests\ItemsFormRequest;
use App\Item;
use App\Repositories\Api\IItemRepository;
use Chromabits\Purifier\Contracts\Purifier;

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
     * @param ItemsFormRequest $request
     * @return Response
     */
	public function store(ItemsFormRequest $request)
	{
		$data = $request->all();
		$data['shop_id'] = 1;
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
     * @param Item $item
     * @return Response
     */
	public function show(Item $item)
	{
		return view('items.show', compact('item'));
	}

    /**
     * Show the form for editing the specified resource.
     *
     * @param ItemsFormRequest $request
     * @param Item $item
     * @return Response
     */
	public function edit(ItemsFormRequest $request, Item $item)
	{
		return view('items.create_edit', compact('item'));
	}

    /**
     * Update the specified resource in storage.
     *
     * @param Item $item
     * @param ItemsFormRequest $request
     * @return Response
     */
	public function update(Item $item,ItemsFormRequest $request)
	{
		$data = $request->all();
		$data = $this->purifier->clean($data);
		$this->item->createOrUpdate($data, $item);

		return redirect()->route('items.show', $item->id);
	}

    /**
     * Remove the specified resource from storage.
     *
     * @param Item $item
     * @return Response
     */
	public function destroy(Item $item)
	{
		$this->item->destroy($item);

		return redirect()->route('items.index');
	}

}
