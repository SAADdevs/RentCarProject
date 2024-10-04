<?php

namespace App\Http\Controllers\ownerCar;
use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\User;
use Illuminate\Http\Request;

class editController extends Controller
{
    public function edite($id)
    {
        $car = Car::findOrFail($id);
        return view('owner.editCar', ['car'=>$car]);
    }

    public function update(Request $request, $id)
    {
        $user = Car::find($id);
        $validatedData = $request->validate([
            'model' => 'required|string|max:255',
            'year' => 'required|integer|min:1886|max:' . date('Y'),
            'price_per_day' => 'required|string|min:0',
            'description' => 'required|string|max:1000',
        ]);

        $user->update($validatedData);

        return redirect()->route('myCars');
    }

    public function destroy($id)
    {
        $user = Car::findOrFail($id);
        $user->delete();
        return redirect()->route('myCars')->with('success', 'Car deleted successfully.');
    }

}
