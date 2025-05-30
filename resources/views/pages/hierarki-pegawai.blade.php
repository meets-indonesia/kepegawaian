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
                                <form id="filterForm" action="{{ route('hierarki-pegawai') }}" method="GET"
                                    class="form-inline">
                                    <div class="form-group mr-2">
                                        <label for="level" class="mr-2">Level Kedalaman:</label>
                                        <select name="level" id="level" class="form-control form-control-md my-3">
                                            <option value="all" {{ request('level') == 'all' ? 'selected' : '' }}>Semua
                                            </option>
                                            @for ($i = 1; $i <= 5; $i++)
                                                <option value="{{ $i }}"
                                                    {{ request('level') == $i ? 'selected' : '' }}>{{ $i }}
                                                </option>
                                            @endfor
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-md btn-primary mr-2">Filter</button>
                                    <a href="{{ route('hierarki-pegawai', ['refresh' => true]) }}"
                                        class="btn btn-md btn-secondary">
                                        <i class="fas fa-sync-alt"></i> Refresh
                                    </a>
                                </form>
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

                        <div class="employee-chart" id="employee-chart">
                            @if (isset($hierarchy) && $hierarchy)
                                <div class="employee-hierarchy">
                                    @include('pages.partials.hierarcy-node', [
                                        'node' => $hierarchy,
                                        'level' => 0,
                                    ])
                                </div>
                            @else
                                <div class="alert alert-info">
                                    Tidak ada data hierarki jabatan struktural.
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <style>
        .employee-chart {
            overflow-x: auto;
            min-height: 600px;
            padding: 20px;
            transition: transform 0.3s ease;
            transform-origin: top center;
        }

        .employee-hierarchy {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding-top: 30px;
        }

        .hierarchy-node {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin: 0 15px;
        }

        .employee-box {
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 10px;
            width: 180px;
            text-align: center;
            background-color: #f8f9fa;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        /* Different role-based colors, based on jenis_pegawai */
        .employee-box[data-role="PNS"] {
            border-left: 4px solid #3498db;
        }

        .employee-box[data-role="Tetap Non-PNS"] {
            border-left: 4px solid #e74c3c;
        }

        .employee-box[data-role="Honorer"] {
            border-left: 4px solid #2ecc71;
        }

        .employee-box[data-role="Tenaga Ahli"] {
            border-left: 4px solid #f39c12;
        }

        .employee-box[data-role="Magang"] {
            border-left: 4px solid #9b59b6;
        }

        .employee-box[data-role="Department"] {
            border-left: 4px solid #1abc9c;
            background-color: #e8f4f8;
        }

        .employee-name {
            font-weight: bold;
            margin-bottom: 5px;
            font-size: 14px;
        }

        .employee-position {
            font-size: 12px;
            color: #6c757d;
        }

        .employee-role {
            font-size: 11px;
            background-color: #e9ecef;
            padding: 2px 6px;
            border-radius: 4px;
            margin-top: 5px;
            display: inline-block;
        }

        .connector {
            width: 2px;
            height: 20px;
            background-color: #6c757d;
            margin: 5px 0;
        }

        .children-connector {
            display: flex;
            justify-content: center;
            position: relative;
        }

        .horizontal-line {
            position: absolute;
            height: 2px;
            background-color: #6c757d;
            top: 0;
        }

        .vertical-line {
            width: 2px;
            height: 20px;
            background-color: #6c757d;
        }

        .children-container {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
        }

        /* Print-friendly styles */
        @media print {
            .employee-chart {
                overflow: visible;
                width: 100%;
            }

            body {
                width: 100%;
                margin: 0;
                padding: 0;
            }
        }
    </style>
@endsection

@section('scripts')
    <script>
        // Zoom functionality
        document.addEventListener('DOMContentLoaded', function() {
            let scale = 1;
            const chart = document.querySelector('.employee-chart');

            // Check if zoom controls exist
            const zoomIn = document.getElementById('zoom-in');
            const zoomOut = document.getElementById('zoom-out');

            if (zoomIn) {
                zoomIn.addEventListener('click', function() {
                    scale += 0.1;
                    chart.style.transform = `scale(${scale})`;
                });
            }

            if (zoomOut) {
                zoomOut.addEventListener('click', function() {
                    if (scale > 0.5) {
                        scale -= 0.1;
                        chart.style.transform = `scale(${scale})`;
                    }
                });
            }

            // Employee box hover effect
            const employeeBoxes = document.querySelectorAll('.employee-box');
            employeeBoxes.forEach(box => {
                box.addEventListener('mouseenter', function() {
                    this.style.boxShadow = '0 4px 8px rgba(0,0,0,0.2)';
                });

                box.addEventListener('mouseleave', function() {
                    this.style.boxShadow = '0 2px 4px rgba(0,0,0,0.1)';
                });
            });
        });
    </script>
@endsection
