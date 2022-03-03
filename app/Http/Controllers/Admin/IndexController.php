<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Measurement;
use App\Services\SolarOptimizationService;

class IndexController extends Controller
{
    public function index()
    {
        return view('admin.index.index', []);
    }

    /**
     * AUTOSET
     */
    public function autoSet(Request $request)
    {
        $formData = $request->validate([
            'onOff' => ['required']
        ]);
        if ($formData['onOff'] == 1) {

            $sos = new SolarOptimizationService();
            $meastrument = new Measurement();

            $data = $sos->getDataFromService();
            $servoData = $meastrument->calculateEngineValues($data);
            $sos->sendDataToServer($servoData);

            $meastrument->title = "Merenje ";
            $meastrument->vertical_engine = $servoData['servo_vertical'];
            $meastrument->horizontal_engine = $servoData['servo_horizontal'];
            $meastrument->fill($data)->save();

            session()->put('auto_active', 'active');

            return response()->json([
                'system_message' => __('Automatska optimizacija je počela!')
            ]);
        } else {

            if (session()->exists('auto_active')) {
                session()->forget('auto_active');
            }

            return response()->json([
                'system_message' => __('Automatska optimizacija je prekinuta!')
            ]);
        }
    }

    /**
     * MANUAL
     */
    public function manualSet()
    {
        $meastruments = Measurement::query()->where('status', 1)->orderBy('created_at', "DESC")->limit(7)->get();
        return view('admin.index.manual', [
            'meastruments' => $meastruments
        ]);
    }


    public function manualSetNow(Request $request)
    {

        $sos = new SolarOptimizationService();
        $meastrument = new Measurement();

        $data = $sos->getDataFromService();
        $servoData = $meastrument->calculateEngineValues($data);
        $sos->sendDataToServer($servoData);

        $meastrument->title = "Merenje ";
        $meastrument->vertical_engine = $servoData['servo_vertical'];
        $meastrument->horizontal_engine = $servoData['servo_horizontal'];
        $meastrument->fill($data)->save();

        return response()->json([
            'system_message' => __('Manual optimization has begun!')
        ]);
    }

    public function manualSetOldValues(Request $request)
    {

        $formData = $request->validate([
            'top_left_sensor' => ['required|numeric|min:0|max:1023'],
            'top_right_sensor' => ['required|numeric|min:0|max:1023'],
            'bottom_left_sensor' => ['required|numeric|min:0|max:1023'],
            'bottom_right_sensor' => ['required|numeric|min:0|max:1023']
        ]);

        $meastrument = Measurement::where('top_left_sensor', $formData['top_left_sensor'])
                                    ->where('top_right_sensor', $formData['top_right_sensor'])
                                    ->where('bottom_left_sensor', $formData['bottom_left_sensor'])
                                    ->where('bottom_right_sensor', $formData['bottom_right_sensor'])
                                    ->get();

            if($meastrument) {
                $meastrument = new Measurement();
                $meastrument->fill($formData);
                $servoData = $meastrument->calculateEngineValues($formData);
                $meastrument->vertical_engine = $servoData['vertical_engine'];
                $meastrument->horizontal_engine = $servoData['horizontal_engine'];
                $meastrument->title = "Novo merenje";
            }
        $servoData = $meastrument->calculateEngineValues($formData);

        $sos = new SolarOptimizationService();
        $sos->sendDataToServer($servoData);

        session()->flash('system_message', 'Manual optimization with old values has begun!');
        return redirect()->route('admin.index.manual_set');
    }

    public function manualSetEnginePositions(Request $request)
    {

        $formData = $request->validate([
            'vertical_engine' => ['required|numeric|min:60|max:160'],
            'horizontal_engine' => ['required|numeric|min:60|max:160']
        ]);

        $sos = new SolarOptimizationService();
        $sos->sendDataToServer($formData);

        session()->flash('system_message', 'Manual optimization with range picker has begun!');
        return redirect()->route('admin.index.manual_set');
    }
}
