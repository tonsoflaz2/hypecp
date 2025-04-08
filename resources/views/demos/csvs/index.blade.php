<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>CSVs by Month</title>
</head>
<body>
	@php
		$months = \App\Models\Csv\Month::where('hype_month', '<', Carbon::now())
									   ->orderByDesc('hype_month')
									   ->get()
									   ->groupBy('hype_month');
	@endphp

	<table>
		@foreach ($grouped_months as $group => $months)
			<tr>
				<td>{{ $group }}</td>
				<td>
					@foreach ($months as $month)
						
					@endforeach
				</td>
			</tr>
		@endforeach
	</table>
</body>
</html>