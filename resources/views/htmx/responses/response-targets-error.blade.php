<div class="p-4 bg-red-100 border border-red-300 rounded-lg">
    <div class="flex items-center">
        <svg class="w-5 h-5 text-red-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
        </svg>
        <h3 class="text-lg font-semibold text-red-800">Server Error</h3>
    </div>
    <div class="mt-3 p-3 bg-red-50 rounded border border-red-200">
        <p class="text-sm text-red-600">
            <strong>Error Details:</strong><br>
            • Status: 500 Internal Server Error<br>
            • Time: {{ now()->format('H:i:s') }}<br>
            • Request ID: {{ Str::random(8) }}
        </p>
    </div>
</div>
