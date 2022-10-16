@extends('layouts.app')

@section('template_title')
    Welcome {{ Auth::user()->name }}
@endsection

@section('head')
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card card-statistics">
                    <div class="card-header">
                        <h4 class="card-title">Estatísticas</h4>
                        <div class="d-flex align-items-center">
                            <p class="card-text font-small-2 me-25 mb-0">Atualizado agora</p>
                        </div>
                    </div>
                    <div class="card-body statistics-body">
                        <div class="row">
                            <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
                                <div class="d-flex flex-row">
                                    <div class="avatar bg-light-primary me-2">
                                        <div class="avatar-content">
                                        </div>
                                    </div>
                                    <div class="my-auto">
                                        <h4 class="fw-bolder mb-0">R$ 98.54</h4>
                                        <p class="card-text font-small-3 mb-0">Pago</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
                                <div class="d-flex flex-row">
                                    <div class="avatar bg-light-info me-2">
                                        <div class="avatar-content">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                 viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                 stroke-linecap="round" stroke-linejoin="round"
                                                 class="feather feather-trending-up avatar-icon">
                                                <polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline>
                                                <polyline points="17 6 23 6 23 12"></polyline>
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="my-auto">
                                        <h4 class="fw-bolder mb-0">R$ 0.00</h4>
                                        <p class="card-text font-small-3 mb-0">Pendente</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-sm-0">
                                <div class="d-flex flex-row">
                                    <div class="avatar bg-light-danger me-2">
                                        <div class="avatar-content">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                 viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                 stroke-linecap="round" stroke-linejoin="round"
                                                 class="feather feather-box avatar-icon">
                                                <path
                                                    d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
                                                <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                                                <line x1="12" y1="22.08" x2="12" y2="12"></line>
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="my-auto">
                                        <h4 class="fw-bolder mb-0">3</h4>
                                        <p class="card-text font-small-3 mb-0">Compradores</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-sm-6 col-12">
                                <div class="d-flex flex-row">
                                    <div class="avatar bg-light-success me-2">
                                        <div class="avatar-content">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                 viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                 stroke-linecap="round" stroke-linejoin="round"
                                                 class="feather feather-dollar-sign avatar-icon">
                                                <line x1="12" y1="1" x2="12" y2="23"></line>
                                                <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="my-auto">
                                        <h4 class="fw-bolder mb-0">2</h4>
                                        <p class="card-text font-small-3 mb-0">Usuários</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row ">
            <div class="  col-2">
                <div class="card">
                    <div class="card-body pb-50" style="position: relative;">
                        <h6>Rifas</h6>
                        <h2 class="fw-bolder mb-1">2</h2>
                        <div id="statistics-order-chart" style="min-height: 85px;">
                            <div id="apexcharts9f7mv9iu"
                                 class="apexcharts-canvas apexcharts9f7mv9iu apexcharts-theme-light"
                                 style="width: 86px; height: 70px;">
                                <svg id="SvgjsSvg1006" width="86" height="70" xmlns="http://www.w3.org/2000/svg"
                                     version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink"
                                     xmlns:svgjs="http://svgjs.com/svgjs" class="apexcharts-svg apexcharts-zoomable"
                                     xmlns:data="ApexChartsNS" transform="translate(0, 0)"
                                     style="background: transparent;">
                                    <g id="SvgjsG1008" class="apexcharts-inner apexcharts-graphical"
                                       transform="translate(11.866666666666667, 15)">
                                        <defs id="SvgjsDefs1007">
                                            <linearGradient id="SvgjsLinearGradient1011" x1="0" y1="0" x2="0" y2="1">
                                                <stop id="SvgjsStop1012" stop-opacity="0.4"
                                                      stop-color="rgba(216,227,240,0.4)" offset="0"></stop>
                                                <stop id="SvgjsStop1013" stop-opacity="0.5"
                                                      stop-color="rgba(190,209,230,0.5)" offset="1"></stop>
                                                <stop id="SvgjsStop1014" stop-opacity="0.5"
                                                      stop-color="rgba(190,209,230,0.5)" offset="1"></stop>
                                            </linearGradient>
                                            <clipPath id="gridRectMask9f7mv9iu">
                                                <rect id="SvgjsRect1016" width="90" height="55" x="-9.866666666666667"
                                                      y="0" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none"
                                                      stroke-dasharray="0" fill="#fff"></rect>
                                            </clipPath>
                                            <clipPath id="gridRectMarkerMask9f7mv9iu">
                                                <rect id="SvgjsRect1017" width="74.26666666666667" height="59" x="-2"
                                                      y="-2" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none"
                                                      stroke-dasharray="0" fill="#fff"></rect>
                                            </clipPath>
                                            <filter id="SvgjsFilter1525" filterUnits="userSpaceOnUse" width="200%"
                                                    height="200%" x="-50%" y="-50%">
                                                <feComponentTransfer id="SvgjsFeComponentTransfer1526"
                                                                     result="SvgjsFeComponentTransfer1526Out"
                                                                     in="SourceGraphic">
                                                    <feFuncR id="SvgjsFeFuncR1527" type="linear" slope="0.5"></feFuncR>
                                                    <feFuncG id="SvgjsFeFuncG1528" type="linear" slope="0.5"></feFuncG>
                                                    <feFuncB id="SvgjsFeFuncB1529" type="linear" slope="0.5"></feFuncB>
                                                    <feFuncA id="SvgjsFeFuncA1530" type="identity"></feFuncA>
                                                </feComponentTransfer>
                                            </filter>
                                        </defs>
                                        <rect id="SvgjsRect1015" width="3.513333333333333" height="55" x="0" y="0"
                                              rx="0" ry="0" opacity="1" stroke-width="0" stroke-dasharray="3"
                                              fill="url(#SvgjsLinearGradient1011)" class="apexcharts-xcrosshairs"
                                              y2="55" filter="none" fill-opacity="0.9"></rect>
                                        <g id="SvgjsG1031" class="apexcharts-xaxis" transform="translate(0, 0)">
                                            <g id="SvgjsG1032" class="apexcharts-xaxis-texts-g"
                                               transform="translate(0, -4)"></g>
                                        </g>
                                        <g id="SvgjsG1034" class="apexcharts-grid">
                                            <g id="SvgjsG1035" class="apexcharts-gridlines-horizontal"
                                               style="display: none;">
                                                <line id="SvgjsLine1037" x1="-7.866666666666667" y1="0"
                                                      x2="78.13333333333333" y2="0" stroke="#e0e0e0"
                                                      stroke-dasharray="0" class="apexcharts-gridline"></line>
                                                <line id="SvgjsLine1038" x1="-7.866666666666667" y1="11"
                                                      x2="78.13333333333333" y2="11" stroke="#e0e0e0"
                                                      stroke-dasharray="0" class="apexcharts-gridline"></line>
                                                <line id="SvgjsLine1039" x1="-7.866666666666667" y1="22"
                                                      x2="78.13333333333333" y2="22" stroke="#e0e0e0"
                                                      stroke-dasharray="0" class="apexcharts-gridline"></line>
                                                <line id="SvgjsLine1040" x1="-7.866666666666667" y1="33"
                                                      x2="78.13333333333333" y2="33" stroke="#e0e0e0"
                                                      stroke-dasharray="0" class="apexcharts-gridline"></line>
                                                <line id="SvgjsLine1041" x1="-7.866666666666667" y1="44"
                                                      x2="78.13333333333333" y2="44" stroke="#e0e0e0"
                                                      stroke-dasharray="0" class="apexcharts-gridline"></line>
                                                <line id="SvgjsLine1042" x1="-7.866666666666667" y1="55"
                                                      x2="78.13333333333333" y2="55" stroke="#e0e0e0"
                                                      stroke-dasharray="0" class="apexcharts-gridline"></line>
                                            </g>
                                            <g id="SvgjsG1036" class="apexcharts-gridlines-vertical"
                                               style="display: none;"></g>
                                            <line id="SvgjsLine1044" x1="0" y1="55" x2="70.26666666666667" y2="55"
                                                  stroke="transparent" stroke-dasharray="0"></line>
                                            <line id="SvgjsLine1043" x1="0" y1="1" x2="0" y2="55" stroke="transparent"
                                                  stroke-dasharray="0"></line>
                                        </g>
                                        <g id="SvgjsG1018" class="apexcharts-bar-series apexcharts-plot-series">
                                            <g id="SvgjsG1019" class="apexcharts-series" seriesName="2020" rel="1"
                                               data:realIndex="0">
                                                <rect id="SvgjsRect1021" width="3.513333333333333" height="55"
                                                      x="-1.7566666666666666" y="0" rx="5" ry="5" opacity="1"
                                                      stroke-width="0" stroke="none" stroke-dasharray="0" fill="#f3f3f3"
                                                      class="apexcharts-backgroundBar" selected="false"></rect>
                                                <path id="SvgjsPath1022"
                                                      d="M-1.7566666666666666 54.12166666666667L-1.7566666666666666 30.25L1.7566666666666666 30.25L1.7566666666666666 30.25L1.7566666666666666 54.12166666666667C0.5855555555555554 55.29277777777778 -0.5855555555555554 55.29277777777778 -1.7566666666666666 54.12166666666667C-1.7566666666666666 54.12166666666667 -1.7566666666666666 54.12166666666667 -1.7566666666666666 54.12166666666667 "
                                                      fill="rgba(255,159,67,0.85)" fill-opacity="1" stroke-opacity="1"
                                                      stroke-linecap="square" stroke-width="0" stroke-dasharray="0"
                                                      class="apexcharts-bar-area" index="0"
                                                      clip-path="url(#gridRectMask9f7mv9iu)"
                                                      pathTo="M -1.7566666666666666 54.12166666666667L -1.7566666666666666 30.25L 1.7566666666666666 30.25L 1.7566666666666666 30.25L 1.7566666666666666 54.12166666666667Q 0 55.87833333333334 -1.7566666666666666 54.12166666666667z"
                                                      pathFrom="M -1.7566666666666666 54.12166666666667L -1.7566666666666666 55L 1.7566666666666666 55L 1.7566666666666666 55L 1.7566666666666666 55L -1.7566666666666666 55"
                                                      cy="30.25" cx="1.7566666666666673" j="0" val="45"
                                                      barHeight="24.75" barWidth="3.513333333333333"
                                                      selected="false"></path>
                                                <rect id="SvgjsRect1023" width="3.513333333333333" height="55" x="15.81"
                                                      y="0" rx="5" ry="5" opacity="1" stroke-width="0" stroke="none"
                                                      stroke-dasharray="0" fill="#f3f3f3"
                                                      class="apexcharts-backgroundBar" selected="false"></rect>
                                                <path id="SvgjsPath1024"
                                                      d="M15.81 54.12166666666667L15.81 8.25L19.323333333333334 8.25L19.323333333333334 8.25L19.323333333333334 54.12166666666667C18.15222222222222 55.29277777777778 16.98111111111111 55.29277777777778 15.81 54.12166666666667C15.81 54.12166666666667 15.81 54.12166666666667 15.81 54.12166666666667 "
                                                      fill="rgba(255,159,67,0.85)" fill-opacity="1" stroke-opacity="1"
                                                      stroke-linecap="square" stroke-width="0" stroke-dasharray="0"
                                                      class="apexcharts-bar-area" index="0"
                                                      clip-path="url(#gridRectMask9f7mv9iu)"
                                                      pathTo="M 15.81 54.12166666666667L 15.81 8.25L 19.323333333333334 8.25L 19.323333333333334 8.25L 19.323333333333334 54.12166666666667Q 17.566666666666666 55.87833333333334 15.81 54.12166666666667z"
                                                      pathFrom="M 15.81 54.12166666666667L 15.81 55L 19.323333333333334 55L 19.323333333333334 55L 19.323333333333334 55L 15.81 55"
                                                      cy="8.25" cx="19.32333333333333" j="1" val="85" barHeight="46.75"
                                                      barWidth="3.513333333333333" selected="false"></path>
                                                <rect id="SvgjsRect1025" width="3.513333333333333" height="55"
                                                      x="33.376666666666665" y="0" rx="5" ry="5" opacity="1"
                                                      stroke-width="0" stroke="none" stroke-dasharray="0" fill="#f3f3f3"
                                                      class="apexcharts-backgroundBar" selected="false"></rect>
                                                <path id="SvgjsPath1026"
                                                      d="M33.376666666666665 54.12166666666667L33.376666666666665 19.25L36.89 19.25L36.89 19.25L36.89 54.12166666666667C35.718888888888884 55.29277777777778 34.547777777777775 55.29277777777778 33.376666666666665 54.12166666666667C33.376666666666665 54.12166666666667 33.376666666666665 54.12166666666667 33.376666666666665 54.12166666666667 "
                                                      fill="rgba(255,159,67,0.85)" fill-opacity="1" stroke-opacity="1"
                                                      stroke-linecap="square" stroke-width="0" stroke-dasharray="0"
                                                      class="apexcharts-bar-area" index="0"
                                                      clip-path="url(#gridRectMask9f7mv9iu)"
                                                      pathTo="M 33.376666666666665 54.12166666666667L 33.376666666666665 19.25L 36.89 19.25L 36.89 19.25L 36.89 54.12166666666667Q 35.13333333333333 55.87833333333334 33.376666666666665 54.12166666666667z"
                                                      pathFrom="M 33.376666666666665 54.12166666666667L 33.376666666666665 55L 36.89 55L 36.89 55L 36.89 55L 33.376666666666665 55"
                                                      cy="19.25" cx="36.89" j="2" val="65" barHeight="35.75"
                                                      barWidth="3.513333333333333" selected="false"></path>
                                                <rect id="SvgjsRect1027" width="3.513333333333333" height="55"
                                                      x="50.94333333333333" y="0" rx="5" ry="5" opacity="1"
                                                      stroke-width="0" stroke="none" stroke-dasharray="0" fill="#f3f3f3"
                                                      class="apexcharts-backgroundBar" selected="false"></rect>
                                                <path id="SvgjsPath1028"
                                                      d="M50.94333333333333 54.12166666666667L50.94333333333333 30.25L54.45666666666666 30.25L54.45666666666666 30.25L54.45666666666666 54.12166666666667C53.285555555555554 55.29277777777778 52.114444444444445 55.29277777777778 50.94333333333333 54.12166666666667C50.94333333333333 54.12166666666667 50.94333333333333 54.12166666666667 50.94333333333333 54.12166666666667 "
                                                      fill="rgba(255,159,67,0.85)" fill-opacity="1" stroke-opacity="1"
                                                      stroke-linecap="square" stroke-width="0" stroke-dasharray="0"
                                                      class="apexcharts-bar-area" index="0"
                                                      clip-path="url(#gridRectMask9f7mv9iu)"
                                                      pathTo="M 50.94333333333333 54.12166666666667L 50.94333333333333 30.25L 54.45666666666666 30.25L 54.45666666666666 30.25L 54.45666666666666 54.12166666666667Q 52.699999999999996 55.87833333333334 50.94333333333333 54.12166666666667z"
                                                      pathFrom="M 50.94333333333333 54.12166666666667L 50.94333333333333 55L 54.45666666666666 55L 54.45666666666666 55L 54.45666666666666 55L 50.94333333333333 55"
                                                      cy="30.25" cx="54.45666666666666" j="3" val="45" barHeight="24.75"
                                                      barWidth="3.513333333333333" selected="false"></path>
                                                <rect id="SvgjsRect1029" width="3.513333333333333" height="55" x="68.51"
                                                      y="0" rx="5" ry="5" opacity="1" stroke-width="0" stroke="none"
                                                      stroke-dasharray="0" fill="#f3f3f3"
                                                      class="apexcharts-backgroundBar" selected="false"></rect>
                                                <path id="SvgjsPath1030"
                                                      d="M68.51 54.12166666666667L68.51 19.25L72.02333333333334 19.25L72.02333333333334 19.25L72.02333333333334 54.12166666666667C70.85222222222222 55.29277777777778 69.68111111111111 55.29277777777778 68.51 54.12166666666667C68.51 54.12166666666667 68.51 54.12166666666667 68.51 54.12166666666667 "
                                                      fill="rgba(255,159,67,0.85)" fill-opacity="1" stroke-opacity="1"
                                                      stroke-linecap="square" stroke-width="0" stroke-dasharray="0"
                                                      class="apexcharts-bar-area" index="0"
                                                      clip-path="url(#gridRectMask9f7mv9iu)"
                                                      pathTo="M 68.51 54.12166666666667L 68.51 19.25L 72.02333333333334 19.25L 72.02333333333334 19.25L 72.02333333333334 54.12166666666667Q 70.26666666666667 55.87833333333334 68.51 54.12166666666667z"
                                                      pathFrom="M 68.51 54.12166666666667L 68.51 55L 72.02333333333334 55L 72.02333333333334 55L 72.02333333333334 55L 68.51 55"
                                                      cy="19.25" cx="72.02333333333334" j="4" val="65" barHeight="35.75"
                                                      barWidth="3.513333333333333" selected="true"
                                                      filter="url(#SvgjsFilter1525)"></path>
                                            </g>
                                            <g id="SvgjsG1020" class="apexcharts-datalabels" data:realIndex="0"></g>
                                        </g>
                                        <line id="SvgjsLine1045" x1="-7.866666666666667" y1="0" x2="78.13333333333333"
                                              y2="0" stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1"
                                              class="apexcharts-ycrosshairs"></line>
                                        <line id="SvgjsLine1046" x1="-7.866666666666667" y1="0" x2="78.13333333333333"
                                              y2="0" stroke-dasharray="0" stroke-width="0"
                                              class="apexcharts-ycrosshairs-hidden"></line>
                                        <g id="SvgjsG1047" class="apexcharts-yaxis-annotations"></g>
                                        <g id="SvgjsG1048" class="apexcharts-xaxis-annotations"></g>
                                        <g id="SvgjsG1049" class="apexcharts-point-annotations"></g>
                                        <rect id="SvgjsRect1050" width="0" height="0" x="0" y="0" rx="0" ry="0"
                                              opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0"
                                              fill="#fefefe" class="apexcharts-zoom-rect"></rect>
                                        <rect id="SvgjsRect1051" width="0" height="0" x="0" y="0" rx="0" ry="0"
                                              opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0"
                                              fill="#fefefe" class="apexcharts-selection-rect"></rect>
                                    </g>
                                    <g id="SvgjsG1033" class="apexcharts-yaxis" rel="0"
                                       transform="translate(-18, 0)"></g>
                                    <g id="SvgjsG1009" class="apexcharts-annotations"></g>
                                </svg>
                                <div class="apexcharts-legend" style="max-height: 35px;"></div>
                                <div class="apexcharts-tooltip apexcharts-theme-light">
                                    <div class="apexcharts-tooltip-series-group" style="order: 1;"><span
                                            class="apexcharts-tooltip-marker"
                                            style="background-color: rgb(255, 159, 67);"></span>
                                        <div class="apexcharts-tooltip-text"
                                             style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;">
                                            <div class="apexcharts-tooltip-y-group"><span
                                                    class="apexcharts-tooltip-text-label"></span><span
                                                    class="apexcharts-tooltip-text-value"></span></div>
                                            <div class="apexcharts-tooltip-z-group"><span
                                                    class="apexcharts-tooltip-text-z-label"></span><span
                                                    class="apexcharts-tooltip-text-z-value"></span></div>
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="apexcharts-yaxistooltip apexcharts-yaxistooltip-0 apexcharts-yaxistooltip-left apexcharts-theme-light">
                                    <div class="apexcharts-yaxistooltip-text"></div>
                                </div>
                            </div>
                        </div>
                        <div class="resize-triggers">
                            <div class="contract-trigger"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class=" col-2">
                <div class="card card-tiny-line-stats">
                    <div class="card-body pb-50" style="position: relative;">
                        <h6>Pedidos</h6>
                        <h2 class="fw-bolder mb-1">5</h2>
                        <div id="statistics-profit-chart" style="min-height: 85px;">
                            <div id="apexchartsm08mufp6"
                                 class="apexcharts-canvas apexchartsm08mufp6 apexcharts-theme-light"
                                 style="width: 86px; height: 70px;">
                                <svg id="SvgjsSvg1052" width="86" height="70" xmlns="http://www.w3.org/2000/svg"
                                     version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink"
                                     xmlns:svgjs="http://svgjs.com/svgjs" class="apexcharts-svg"
                                     xmlns:data="ApexChartsNS" transform="translate(0, 0)"
                                     style="background: transparent;">
                                    <g id="SvgjsG1054" class="apexcharts-inner apexcharts-graphical"
                                       transform="translate(12, 0)">
                                        <defs id="SvgjsDefs1053">
                                            <clipPath id="gridRectMaskm08mufp6">
                                                <rect id="SvgjsRect1059" width="71" height="68" x="-3.5" y="-1.5" rx="0"
                                                      ry="0" opacity="1" stroke-width="0" stroke="none"
                                                      stroke-dasharray="0" fill="#fff"></rect>
                                            </clipPath>
                                            <clipPath id="gridRectMarkerMaskm08mufp6">
                                                <rect id="SvgjsRect1060" width="76" height="77" x="-6" y="-6" rx="0"
                                                      ry="0" opacity="1" stroke-width="0" stroke="none"
                                                      stroke-dasharray="0" fill="#fff"></rect>
                                            </clipPath>
                                        </defs>
                                        <line id="SvgjsLine1058" x1="-0.5" y1="0" x2="-0.5" y2="65" stroke="#b6b6b6"
                                              stroke-dasharray="3" class="apexcharts-xcrosshairs" x="-0.5" y="0"
                                              width="1" height="65" fill="#b1b9c4" filter="none" fill-opacity="0.9"
                                              stroke-width="1"></line>
                                        <g id="SvgjsG1077" class="apexcharts-xaxis" transform="translate(0, 0)">
                                            <g id="SvgjsG1078" class="apexcharts-xaxis-texts-g"
                                               transform="translate(0, -4)">
                                                <text id="SvgjsText1080" font-family="Helvetica, Arial, sans-serif"
                                                      x="0" y="94" text-anchor="middle" dominant-baseline="auto"
                                                      font-size="0px" font-weight="400" fill="#373d3f"
                                                      class="apexcharts-text apexcharts-xaxis-label "
                                                      style="font-family: Helvetica, Arial, sans-serif;">
                                                    <tspan id="SvgjsTspan1081">1</tspan>
                                                    <title>1</title></text>
                                                <text id="SvgjsText1083" font-family="Helvetica, Arial, sans-serif"
                                                      x="12.800000000000002" y="94" text-anchor="middle"
                                                      dominant-baseline="auto" font-size="0px" font-weight="400"
                                                      fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label "
                                                      style="font-family: Helvetica, Arial, sans-serif;">
                                                    <tspan id="SvgjsTspan1084">2</tspan>
                                                    <title>2</title></text>
                                                <text id="SvgjsText1086" font-family="Helvetica, Arial, sans-serif"
                                                      x="25.6" y="94" text-anchor="middle" dominant-baseline="auto"
                                                      font-size="0px" font-weight="400" fill="#373d3f"
                                                      class="apexcharts-text apexcharts-xaxis-label "
                                                      style="font-family: Helvetica, Arial, sans-serif;">
                                                    <tspan id="SvgjsTspan1087">3</tspan>
                                                    <title>3</title></text>
                                                <text id="SvgjsText1089" font-family="Helvetica, Arial, sans-serif"
                                                      x="38.4" y="94" text-anchor="middle" dominant-baseline="auto"
                                                      font-size="0px" font-weight="400" fill="#373d3f"
                                                      class="apexcharts-text apexcharts-xaxis-label "
                                                      style="font-family: Helvetica, Arial, sans-serif;">
                                                    <tspan id="SvgjsTspan1090">4</tspan>
                                                    <title>4</title></text>
                                                <text id="SvgjsText1092" font-family="Helvetica, Arial, sans-serif"
                                                      x="51.199999999999996" y="94" text-anchor="middle"
                                                      dominant-baseline="auto" font-size="0px" font-weight="400"
                                                      fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label "
                                                      style="font-family: Helvetica, Arial, sans-serif;">
                                                    <tspan id="SvgjsTspan1093">5</tspan>
                                                    <title>5</title></text>
                                                <text id="SvgjsText1095" font-family="Helvetica, Arial, sans-serif"
                                                      x="63.99999999999999" y="94" text-anchor="middle"
                                                      dominant-baseline="auto" font-size="0px" font-weight="400"
                                                      fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label "
                                                      style="font-family: Helvetica, Arial, sans-serif;">
                                                    <tspan id="SvgjsTspan1096">6</tspan>
                                                    <title>6</title></text>
                                            </g>
                                        </g>
                                        <g id="SvgjsG1098" class="apexcharts-grid">
                                            <g id="SvgjsG1099" class="apexcharts-gridlines-horizontal"></g>
                                            <g id="SvgjsG1100" class="apexcharts-gridlines-vertical">
                                                <line id="SvgjsLine1101" x1="0" y1="0" x2="0" y2="65" stroke="#ebebeb"
                                                      stroke-dasharray="5" class="apexcharts-gridline"></line>
                                                <line id="SvgjsLine1102" x1="12.8" y1="0" x2="12.8" y2="65"
                                                      stroke="#ebebeb" stroke-dasharray="5"
                                                      class="apexcharts-gridline"></line>
                                                <line id="SvgjsLine1103" x1="25.6" y1="0" x2="25.6" y2="65"
                                                      stroke="#ebebeb" stroke-dasharray="5"
                                                      class="apexcharts-gridline"></line>
                                                <line id="SvgjsLine1104" x1="38.400000000000006" y1="0"
                                                      x2="38.400000000000006" y2="65" stroke="#ebebeb"
                                                      stroke-dasharray="5" class="apexcharts-gridline"></line>
                                                <line id="SvgjsLine1105" x1="51.2" y1="0" x2="51.2" y2="65"
                                                      stroke="#ebebeb" stroke-dasharray="5"
                                                      class="apexcharts-gridline"></line>
                                                <line id="SvgjsLine1106" x1="64" y1="0" x2="64" y2="65" stroke="#ebebeb"
                                                      stroke-dasharray="5" class="apexcharts-gridline"></line>
                                            </g>
                                            <line id="SvgjsLine1108" x1="0" y1="65" x2="64" y2="65" stroke="transparent"
                                                  stroke-dasharray="0"></line>
                                            <line id="SvgjsLine1107" x1="0" y1="1" x2="0" y2="65" stroke="transparent"
                                                  stroke-dasharray="0"></line>
                                        </g>
                                        <g id="SvgjsG1061" class="apexcharts-line-series apexcharts-plot-series">
                                            <g id="SvgjsG1062" class="apexcharts-series" seriesName="seriesx1"
                                               data:longestSeries="true" rel="1" data:realIndex="0">
                                                <path id="SvgjsPath1076"
                                                      d="M0 65L12.8 39L25.6 58.5L38.4 26L51.2 45.5L64 6.5C64 6.5 64 6.5 64 6.5 "
                                                      fill="none" fill-opacity="1" stroke="rgba(0,207,232,0.85)"
                                                      stroke-opacity="1" stroke-linecap="butt" stroke-width="3"
                                                      stroke-dasharray="0" class="apexcharts-line" index="0"
                                                      clip-path="url(#gridRectMaskm08mufp6)"
                                                      pathTo="M 0 65L 12.8 39L 25.6 58.5L 38.4 26L 51.2 45.5L 64 6.5"
                                                      pathFrom="M -1 65L -1 65L 12.8 65L 25.6 65L 38.4 65L 51.2 65L 64 65"></path>
                                                <g id="SvgjsG1063" class="apexcharts-series-markers-wrap"
                                                   data:realIndex="0">
                                                    <g id="SvgjsG1065" class="apexcharts-series-markers"
                                                       clip-path="url(#gridRectMarkerMaskm08mufp6)">
                                                        <circle id="SvgjsCircle1066" r="2" cx="0" cy="65"
                                                                class="apexcharts-marker no-pointer-events wjwczh8se"
                                                                stroke="#00cfe8" fill="#00cfe8" fill-opacity="1"
                                                                stroke-width="2" stroke-opacity="1" rel="0" j="0"
                                                                index="0" default-marker-size="2"></circle>
                                                        <circle id="SvgjsCircle1067" r="2" cx="12.8" cy="39"
                                                                class="apexcharts-marker no-pointer-events wimj4il1bh"
                                                                stroke="#00cfe8" fill="#00cfe8" fill-opacity="1"
                                                                stroke-width="2" stroke-opacity="1" rel="1" j="1"
                                                                index="0" default-marker-size="2"></circle>
                                                    </g>
                                                    <g id="SvgjsG1068" class="apexcharts-series-markers"
                                                       clip-path="url(#gridRectMarkerMaskm08mufp6)">
                                                        <circle id="SvgjsCircle1069" r="2" cx="25.6" cy="58.5"
                                                                class="apexcharts-marker no-pointer-events w53eg92ll"
                                                                stroke="#00cfe8" fill="#00cfe8" fill-opacity="1"
                                                                stroke-width="2" stroke-opacity="1" rel="2" j="2"
                                                                index="0" default-marker-size="2"></circle>
                                                    </g>
                                                    <g id="SvgjsG1070" class="apexcharts-series-markers"
                                                       clip-path="url(#gridRectMarkerMaskm08mufp6)">
                                                        <circle id="SvgjsCircle1071" r="2" cx="38.4" cy="26"
                                                                class="apexcharts-marker no-pointer-events wbiz005hsi"
                                                                stroke="#00cfe8" fill="#00cfe8" fill-opacity="1"
                                                                stroke-width="2" stroke-opacity="1" rel="3" j="3"
                                                                index="0" default-marker-size="2"></circle>
                                                    </g>
                                                    <g id="SvgjsG1072" class="apexcharts-series-markers"
                                                       clip-path="url(#gridRectMarkerMaskm08mufp6)">
                                                        <circle id="SvgjsCircle1073" r="2" cx="51.2" cy="45.5"
                                                                class="apexcharts-marker no-pointer-events w0ydkjg23"
                                                                stroke="#00cfe8" fill="#00cfe8" fill-opacity="1"
                                                                stroke-width="2" stroke-opacity="1" rel="4" j="4"
                                                                index="0" default-marker-size="2"></circle>
                                                    </g>
                                                    <g id="SvgjsG1074" class="apexcharts-series-markers"
                                                       clip-path="url(#gridRectMarkerMaskm08mufp6)">
                                                        <circle id="SvgjsCircle1075" r="5" cx="64" cy="6.5"
                                                                class="apexcharts-marker no-pointer-events w3wiyjds8j"
                                                                stroke="#00cfe8" fill="#ffffff" fill-opacity="1"
                                                                stroke-width="2" stroke-opacity="1" rel="5" j="5"
                                                                index="0" default-marker-size="5"></circle>
                                                    </g>
                                                </g>
                                            </g>
                                            <g id="SvgjsG1064" class="apexcharts-datalabels" data:realIndex="0"></g>
                                        </g>
                                        <line id="SvgjsLine1109" x1="0" y1="0" x2="64" y2="0" stroke="#b6b6b6"
                                              stroke-dasharray="0" stroke-width="1"
                                              class="apexcharts-ycrosshairs"></line>
                                        <line id="SvgjsLine1110" x1="0" y1="0" x2="64" y2="0" stroke-dasharray="0"
                                              stroke-width="0" class="apexcharts-ycrosshairs-hidden"></line>
                                        <g id="SvgjsG1111" class="apexcharts-yaxis-annotations"></g>
                                        <g id="SvgjsG1112" class="apexcharts-xaxis-annotations"></g>
                                        <g id="SvgjsG1113" class="apexcharts-point-annotations"></g>
                                    </g>
                                    <rect id="SvgjsRect1057" width="0" height="0" x="0" y="0" rx="0" ry="0" opacity="1"
                                          stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fefefe"></rect>
                                    <g id="SvgjsG1097" class="apexcharts-yaxis" rel="0"
                                       transform="translate(-18, 0)"></g>
                                    <g id="SvgjsG1055" class="apexcharts-annotations"></g>
                                </svg>
                                <div class="apexcharts-legend" style="max-height: 35px;"></div>

                                <div
                                    class="apexcharts-yaxistooltip apexcharts-yaxistooltip-0 apexcharts-yaxistooltip-left apexcharts-theme-light">
                                    <div class="apexcharts-yaxistooltip-text"></div>
                                </div>
                            </div>
                        </div>
                        <div class="resize-triggers">
                            <div class="contract-trigger"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-8 col-8">
                <div class="card card-company-table">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Comprador</th>
                                    <th>Código</th>
                                    <th>Telefone</th>
                                    <th>Status</th>
                                    <th>Total</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div>
                                                <div class="fw-bolder">Lindomar Silva</div>
                                                <div class="font-small-2 text-muted">lindomar@teste.com</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <span>12</span>
                                        </div>
                                    </td>
                                    <td class="text-nowrap">
                                        (24) 99873-4138
                                    </td>
                                    <td>Pago</td>
                                    <td>R$51,21</td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div>
                                                <div class="fw-bolder">FRANCISCO TESTE</div>
                                                <div class="font-small-2 text-muted">francisco@teste.com</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <span>13</span>
                                        </div>
                                    </td>
                                    <td class="text-nowrap">
                                        (61) 98533-2563
                                    </td>
                                    <td>Pago</td>
                                    <td>R$20,32</td>
                                </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-lg-10 offset-lg-1">

                @include('panels.welcome-panel')

            </div>
        </div>
    </div>


@endsection
