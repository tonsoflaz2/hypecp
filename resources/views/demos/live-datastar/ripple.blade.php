@php
	use Illuminate\Support\Facades\Redis;

	$redis = Redis::connection();

	$id = request('id');

	$signal = [
	    'x' => request('x'), 
	    'y' => request('y'),
	    'z' => request('z')
	];

	$signals = [];
	if ($json_signals = $redis->get('ripple_signals')) {
	    $signals = json_decode($json_signals, true);
	}
	$signals[] = $signal;
	$redis->set('ripple_signals', json_encode($signals));

	$now = time();
	$redis->hset('ripple_users', $id, $now);

	$all = $redis->hgetall('ripple_users');
	foreach ($all as $userId => $timestamp) {
	    if ($now - intval($timestamp) > 60) {
	        $redis->hdel('ripple_users', $userId);
	    }
	}
@endphp
