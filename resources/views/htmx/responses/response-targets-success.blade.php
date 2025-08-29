<div class="p-4 bg-green-100 border border-green-300 rounded-lg">
    <div class="flex items-center">
        <svg class="w-5 h-5 text-green-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
        </svg>
        <h3 class="text-lg font-semibold text-green-800">Registration Successful!</h3>
    </div>
    <div class="mt-3 p-3 bg-green-50 rounded border border-green-200">
        <p class="text-sm text-green-600">
            <strong>Account Details:</strong><br>
            • Email: user@example.com<br>
            • Plan: Basic<br>
            • Status: Active<br>
            • Time: {{ now()->format('H:i:s') }}<br>
            • Request ID: {{ Str::random(8) }}
        </p>
    </div>
</div>
