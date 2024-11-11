<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomerAddress;

class CustomerAddressController extends Controller
{
    
    public function store(Request $request) {
        $isDefault = CustomerAddress::DEFAULT;
        $hasAddressIsDefault = [];
        $flash = array(
            'status' => 'success',
            'message' => 'Successfully added new customer address'
        );

        try {
            $data = $request->all();

            isset($data['gender']) && $data['gender'] == '1'
                ? $data['gender'] = CustomerAddress::GENDER_MALE
                : $data['gender'] = CustomerAddress::GENDER_FEMALE;

            $data['user_id'] = $data['user_id'] ?? auth()->user()->id;

            $addressModel = new CustomerAddress();
            $addressRow = CustomerAddress::where('user_id', $data['user_id'])->get();

            if(!empty($addressRow)) {
                foreach ($addressRow as $item) {
                    if($item->is_default == $isDefault) {
                        $hasAddressIsDefault[] = $item;
                    }
                }
            }
            if(empty($hasAddressIsDefault)) {
                $data['is_default'] = $isDefault;
            }
            $this->prepareAddressDataModel($addressModel, $data);

            if(isset($data['is_default']) && $data['is_default'] == CustomerAddress::DEFAULT) {
                CustomerAddress::updateOtherDefault($addressModel->id, $data['user_id'])->update([
                    'is_default' => CustomerAddress::NOT_DEFAULT,
                ]);
            }
        } catch (\Exception $e) {
            $flash['status']  = 'error';
            $flash['message'] = $e->getMessage();
        }
        return redirect()->back()->with($flash['status'], $flash['message']);
    }


    public function showFormEditProfile($id) {
      
            /** @var CustomerAddress $addressInfo */
            $addressInfo = CustomerAddress::findOrFail($id);
            if($addressInfo){
                return response()->json([
                    'status' =>200,
                    'addressInfo' => $addressInfo,
                ]);
            }
            else{
                 return response()->json([
                    'status' =>404,
                    'addressInfo' => $addressInfo,
                    'message' =>"Address not found!",
                ]);
            }
    }

    public function update($id, Request $request) {
        $flash = array(
            'status' => 'success',
            'message' => 'Successfully updated'
        );

        try {
            $data        = $request->all();
            $userAddress = CustomerAddress::findOrFail($id);
            $isDefault   = $data['is_default'] ?? CustomerAddress::NOT_DEFAULT;

            $data['user_id'] = $data['user_id'] ?? auth()->user()->id;
            $this->prepareAddressDataModel($userAddress, $data);

            if($isDefault == CustomerAddress::DEFAULT) {
                CustomerAddress::updateOtherDefault($id, $data['user_id'])->update([
                    'is_default' => CustomerAddress::NOT_DEFAULT,
                ]);
            }
        } catch (\Exception $e) {
            $flash['status']  = 'error';
            $flash['message'] = $e->getMessage();
        }

        return redirect()->back()->with($flash['status'], $flash['message']);
    }

    public function destroy($id) {
        $flash = array(
            'status' => 'success',
            'message' => 'Address Successfully deleted'
        );

        try {
            $address = CustomerAddress::where('id', $id)->firstOrFail();

            if (isset($address) && $address->is_default == CustomerAddress::DEFAULT) {
                $flash['status'] = 'error';
                $flash['message'] = 'Must change default profile before delete !';

                return redirect()->back()->with($flash['status'], $flash['message']);
            } else {
                $address->delete();
            }
        } catch (\Exception $e) {
            $flash['status']  = 'error';
            $flash['message'] = $e->getMessage();
        }

        return redirect()->back()->with($flash['status'], $flash['message']);
    }



    public function prepareAddressDataModel($addressModel, $data) {
        $addressModel->user_id        = $data['user_id'] ?? null ;
        $addressModel->name           = $data['address_name'] ?? '';
        $addressModel->gender         = $data['gender'] ?? 0;
        $addressModel->phone_number   = $data['address_phone_number'] ?? null;
        $addressModel->email          = $data['address_email'] ?? '';
        $addressModel->detail_address = $data['address_detail'] ?? '';
        $addressModel->is_default     = $data['is_default'] ?? 0;

        $addressModel->save();
    }

    //Frontend
    public function addNewAddress(Request $request){
        $isDefault = CustomerAddress::DEFAULT;
        $hasAddressIsDefault = [];
        $flash = array(
            'status' => 'success',
            'message' => 'Successfully added new customer address'
        );

        try {
            $data = $request->all();

            isset($data['gender']) && $data['gender'] == '1'
                ? $data['gender'] = CustomerAddress::GENDER_MALE
                : $data['gender'] = CustomerAddress::GENDER_FEMALE;

            $data['user_id'] = $data['user_id'] ?? auth()->user()->id;

            $addressModel = new CustomerAddress();
            $addressRow = CustomerAddress::where('user_id', $data['user_id'])->get();

            if(!empty($addressRow)) {
                foreach ($addressRow as $item) {
                    if($item->is_default == $isDefault) {
                        $hasAddressIsDefault[] = $item;
                    }
                }
            }
            if(empty($hasAddressIsDefault)) {
                $data['is_default'] = $isDefault;
            }
            $this->prepareAddressDataModel($addressModel, $data);

            if(isset($data['is_default']) && $data['is_default'] == CustomerAddress::DEFAULT) {
                CustomerAddress::updateOtherDefault($addressModel->id, $data['user_id'])->update([
                    'is_default' => CustomerAddress::NOT_DEFAULT,
                ]);
            }
        } catch (\Exception $e) {
            $flash['status']  = 'error';
            $flash['message'] = $e->getMessage();
        }
        return redirect()->back()->with($flash['status'], $flash['message']);
    }

    public function updateDefaultAddress(Request $request)
    {

        $addressId = $request->input('address_id');
        CustomerAddress::where('is_default', 1)->update(['is_default' => 0]);
        CustomerAddress::find($addressId)->update(['is_default' => 1]);

        return response()->json(['success' => true]);
    }


}
