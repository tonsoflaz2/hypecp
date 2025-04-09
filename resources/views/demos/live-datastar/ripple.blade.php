@php

	$redis = \Illuminate\Support\Facades\Redis::connection();

	if ($json_signals = $redis->get('ripple_signals')) {
           $signals = json_decode($json_signals, true);
	} else {
		$signals = [];
	}
	$signal = ['x' => request('x'), 
			   'y' => request('y'),
			   'z' => request('z')];

	$signals[] = $signal;
	$redis->set('ripple_signals', json_encode($signals));
@endphp