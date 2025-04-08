@php
	$encoded = json_encode(['x' => request('x'), 
							'y' => request('y'),
							'z' => request('z')]);
	$redis = \Illuminate\Support\Facades\Redis::connection();
	$redis->set('ripple_signal', $encoded);
@endphp