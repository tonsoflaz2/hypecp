<div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
    <h3 class="text-blue-800 font-semibold mb-3">📋 Form Response (Preloaded!)</h3>
    
    <div class="space-y-2 text-sm">
        <div class="flex items-center gap-2">
            <span class="font-medium text-blue-700">Plan:</span>
            <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded">{{ ucfirst($plan) }}</span>
        </div>
        
        <div class="flex items-center gap-2">
            <span class="font-medium text-blue-700">Features:</span>
            @if(empty($features))
                <span class="text-blue-600 italic">None selected</span>
            @else
                @foreach($features as $feature)
                    <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded">{{ ucfirst($feature) }}</span>
                @endforeach
            @endif
        </div>
        
        <div class="flex items-center gap-2">
            <span class="font-medium text-blue-700">Region:</span>
            <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded">{{ strtoupper($region) }}</span>
        </div>
    </div>
    
    <div class="mt-4 p-3 bg-blue-100 rounded">
        <p class="text-xs text-blue-700">
            💡 <strong>Preload:</strong> This response was cached when you hovered over the form elements (check the inspect element network tab). 
            The actual form submission will use this cached response for instant display.
        </p>
    </div>
</div> 