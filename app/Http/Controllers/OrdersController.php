<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\OrdersFormRequest;
use App\Order;
use App\Repositories\Api\IOrderRepository;
use Auth;
use Chromabits\Purifier\Contracts\Purifier;
use Illuminate\Http\Request;

class OrdersController extends Controller {

    public function __construct(IOrderRepository $order, Purifier $purifier) {

        $this->order = $order;
        $this->purifier = $purifier;

        $this->middleware('auth', ['only' => ['create', 'store', 'edit', 'update', 'destroy', 'index']]);
        $this->middleware('manager', ['only' => ['create', 'store', 'edit', 'update', 'destroy', 'index']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @param OrdersFormRequest $request
     * @return Response
     */
	public function index(OrdersFormRequest $request)
	{
        $orders = $this->order->getOrdersByBuyerId(Auth::id());

        return view('orders.index', compact('orders'));
	}

    /**
     * Show the form for creating a new resource.
     *
     * @param OrdersFormRequest $request
     * @return Response
     */
	public function create(OrdersFormRequest $request)
	{
		return view('orders.create_edit');
	}

    /**
     * Store a newly created resource in storage.
     *
     * @param OrdersFormRequest $request
     * @return Response
     */
	public function store(OrdersFormRequest $request)
	{
        $orderData = $this->purifier->clean($request->all());
        $items = $this->purifier($request->input('items_list'));

		$order = $this->order->createOrUpdate($orderData);
        $this->order->updateItemsToOrder($order, $items);

        return redirect()->route('orders');
	}

    /**
     * Display the specified resource.
     *
     * @param Order $order
     * @param OrdersFormRequest $request
     * @return Response
     */
	public function show(Order $order, OrdersFormRequest $request)
	{
		return view('orders.show', compact('order'));
	}

    /**
     * Show the form for editing the specified resource.
     *
     * @param Order $order
     * @param OrdersFormRequest $request
     * @return Response
     */
	public function edit(Order $order, OrdersFormRequest $request)
	{
		return view('orders.create_edit', compact('order'));
	}

    /**
     * Update the specified resource in storage.
     *
     * @param Order $order
     * @param OrdersFormRequest $request
     * @return Response
     */
	public function update(Order $order, OrdersFormRequest $request)
	{
        $data = $this->purifier->clean($request->all());
        $items = $this->purifier($request->input('items_list'));

        $this->order->createOrUpdate($data, $order);
        $this->order->updateItemsToOrder($order, $items);

        return redirect()->route('orders');
	}

    /**
     * Remove the specified resource from storage.
     *
     * @param Order $order
     * @param OrdersFormRequest $request
     * @return Response
     */
	public function destroy(Order $order, OrdersFormRequest $request)
	{
        $this->order->destroyOrder($order);

        return redirect()->route('orders.index');
	}


}
