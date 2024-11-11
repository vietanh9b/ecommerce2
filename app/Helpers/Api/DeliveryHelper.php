<?php


namespace App\Helpers\Api;


use App\Repositories\OrderRepository;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Svg\Tag\Image;

class DeliveryHelper
{
    const STATUS_HAS_BEEN_TAKEN = 'process';
    const STATUS_HAS_BEEN_DELIVERED = 'delivered';
    const STATUS_NEW_ORDER = 'new';

    /**
     * @param $accessToken
     * @param $request
     * @return mixed
     * @throws \Exception
     */
    public function processCommonOrder($accessToken, $request)
    {
        $helper = new CartHelper();
        $currentUser = $helper->getCurrentUserWithAccessToken($accessToken);
        if (empty($currentUser)) {
            throw new \Exception(' User not exists');
        }
        $orderId = $request->get('order_id');
        $orderRepository = new OrderRepository();

        return $orderRepository->getOrderDetail($orderId);
    }

    /**
     * @param $accessToken
     * @param $request
     * @return void
     * @throws \Exception
     */
    public function processTakeOrder($accessToken, $request)
    {
        $order = $this->processCommonOrder($accessToken, $request)->first();
        if (empty($order)) {
            throw new \Exception(' The Order not exist');
        }
        if ($order->status == self::STATUS_HAS_BEEN_TAKEN) {
            throw new \Exception(' The Order has been taken');
        }
        if ($order->status == self::STATUS_HAS_BEEN_DELIVERED) {
            throw new \Exception(' The Order has been delivered');
        }
        $order->update(['status' => self::STATUS_HAS_BEEN_TAKEN]);
    }

    /**
     * @param $accessToken
     * @param $request
     * @return void
     * @throws \Exception
     */
    public function processDeliveryOrder($accessToken, $request)
    {
        $order = $this->processCommonOrder($accessToken, $request)->first();
        if (empty($order)) {
            throw new \Exception(' The Order not exist');
        }
        if ($order->status == self::STATUS_NEW_ORDER) {
            throw new \Exception(' The Order has not been taken, Please take order first');
        }
        if ($order->status == self::STATUS_HAS_BEEN_DELIVERED) {
            throw new \Exception(' The Order has been delivered');
        }

        if (!empty($order)) {

            if($request->hasFile('photo')) {
                $file = $request->file('photo');
                $photo = Str::uuid() . "." . $file->getClientOriginalExtension();
                $file->storeAs(config('chatify.attachments.folder'), $photo, config('chatify.storage_disk_name'));
                $path = Storage::disk(config('chatify.storage_disk_name'))
                    ->url(config('chatify.attachments.folder') . '/' . $photo);

                $order->photo = $path;
            }

            $order->time = date('d-m-Y h:i:s');

            $order->save();
        }

        $order->update(['status' => self::STATUS_HAS_BEEN_DELIVERED]);
    }

    
}


