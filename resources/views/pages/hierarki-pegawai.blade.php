@extends('layouts.main_layout')

@section('content')
<div class="container-fluid">
    <div class="row mb-3">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">Bagan Hierarki Pegawai</h4>
                    <div class="button-group">
                        <div class="btn-group mr-2">
                            <button id="zoom-in" class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-search-plus"></i> Zoom In
                            </button>
                            <button id="zoom-out" class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-search-minus"></i> Zoom Out
                            </button>
                        </div>
                        <button class="btn btn-sm btn-outline-secondary" onclick="window.print()">
                            <i class="fas fa-print"></i> Print
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mb-3 mt-3">
                        <div class="col-md-4">
                            <label for="level-select">Tingkat kedalaman:</label>
                            <select id="level-select">
                                @if(isset($maxDepth) && $maxDepth > 0)
                                    @for ($i = 1; $i <= $maxDepth; $i++)
                                        <option value="{{ $i }}">{{ $i }} Level</option>
                                    @endfor
                                @endif
                                <option value="all" selected>Tunjukkan semua</option>
                            </select>

                        </div>
                        <div class="col-md-8">
                            <div class="d-flex justify-content-end">
                                <div class="legend">
                                    @if (isset($jenisPegawai))
                                    @foreach ($jenisPegawai as $jenis)
                                    <span class="badge badge-pill mb-1 text-black"
                                        style="border-left: 4px solid {{ $loop->iteration % 6 == 1 ? '#3498db' : ($loop->iteration % 6 == 2 ? '#e74c3c' : ($loop->iteration % 6 == 3 ? '#2ecc71' : ($loop->iteration % 6 == 4 ? '#f39c12' : ($loop->iteration % 6 == 5 ? '#9b59b6' : '#1abc9c')))) }}; padding-left: 8px; margin-right: 5px;">
                                        {{ $jenis->name }}
                                    </span>
                                    @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="row justify-content-center">
                        <div id="chart-container" class="col-auto"></div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('additional-styles')
<link rel="stylesheet" href="/assets/css/orgchart.min.css">
<style>
    .orgchart {
    background-image: none !important;
}
    /* Styles for node colors (unchanged) */
    @foreach ($jenisPegawai as $jenis)
    .orgchart .{{ str_replace(' ', '', $jenis->name) }} .title {
        background-color: {{ $loop->iteration % 6 == 1 ? '#3498db' : ($loop->iteration % 6 == 2 ? '#e74c3c' : ($loop->iteration % 6 == 3 ? '#2ecc71' : ($loop->iteration % 6 == 4 ? '#f39c12' : ($loop->iteration % 6 == 5 ? '#9b59b6' : '#1abc9c')))) }};
        /* Blue */
    }
    @endforeach

    .orgchart .none .title {
        background-color:rgb(148, 71, 0);
        /* Blue */
    }


    /* Basic styling for the controls container and select dropdown */
    .controls {
        margin-bottom: 20px;
        text-align: center;
        /* Center the dropdown */
        padding: 10px;
        background-color: #f8f9fa;
        /* Light background for the control area */
        border-radius: 8px;
        display: inline-block;
        /* Allow centering if body is flex */
    }

    #level-select {
        padding: 8px 12px;
        border-radius: 4px;
        border: 1px solid #ced4da;
        font-size: 1em;
    }

    label {
        margin-right: 10px;
        font-weight: bold;
    }
</style>
@endsection

@section('additional-scripts')


<script src="/assets/js/orgchart.min.js"></script>
<script>
    $(function() {
        // Store the chart data and base options globally within this scope
        const chartData = 
        @include('pages.partials.hierarchy-data', [
            'node' => $hierarchy,
        ])

        const baseChartOptions = {
            'data': chartData,
            'nodeContent': 'title',
            'nodeTitle': 'name',
            'pan': true,
            'zoom': true,
            'exportButton': false,
            'exportFilename': 'OrgChart-ControlledDepth-v5'
            // 'visibleLevel' will be added dynamically by renderOrgChart
        };

        // Function to render or re-render the org chart
        function renderOrgChart(depthValue) {
            const $chartContainer = $('#chart-container');

            // Clear any existing chart to prevent issues with re-initialization
            // For OrgChart v5+, it's better to remove the plugin instance if it exists
            if ($chartContainer.data('orgchart')) {
                // Attempt to remove/destroy if a method exists, otherwise just empty
                // The dabeng/OrgChart doesn't have a public destroy method in older jQuery versions.
                // For v5, emptying and re-initializing is generally the way.
            }
            $chartContainer.empty();

            let currentDepth;
            if (depthValue === 'all') {
                currentDepth = 999; // A large number to show all levels (as per v5 docs)
            } else {
                currentDepth = parseInt(depthValue, 10);
            }

            // Log the depth being used for rendering
            console.log('Attempting to render chart with visibleLevel:', currentDepth);

            // Use 'visibleLevel' for OrgChart v5+
            const chartOptions = {
                ...baseChartOptions,
                'visibleLevel': currentDepth
            };

            $chartContainer.orgchart(chartOptions);
        }

        // Initial render with the default depth from the select dropdown
        const initialDepth = $('#level-select').val();
        renderOrgChart(initialDepth);

        // Event listener for the select dropdown
        $('#level-select').on('change', function() {
            // Log when the select value changes
            console.log('Level select changed to: ' + $(this).val() + '. Re-rendering chart.');
            renderOrgChart($(this).val());
        });
    });
</script>
@endsection