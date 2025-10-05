<?php

namespace App\DataTables;

use App\Models\BonDeLivraison;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Illuminate\Http\Request;
use Yajra\DataTables\Services\DataTable;

class BonDeLivraisonDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        $rowColumn = ['bon_de_livraison_id', 'issue_date', 'status','action'];
        $dataTable = (new EloquentDataTable($query))
            ->addIndexColumn()
            ->editColumn('bon_de_livraison_id', function (BonDeLivraison $bonDeLivraison) {
                $url = route('bon-de-livraison.show', \Crypt::encrypt($bonDeLivraison->id));
                return '<a href="' . $url . '" class="btn btn-outline-primary">' . \App\Models\BonDeLivraison::bonDeLivraisonNumberFormat($bonDeLivraison->bon_de_livraison_id) . '</a>';
            })
            ->editColumn('issue_date', function (BonDeLivraison $bonDeLivraison) {
                return company_date_formate($bonDeLivraison->issue_date);
            })
            ->editColumn('status', function (BonDeLivraison $bonDeLivraison) {
                if ($bonDeLivraison->status == 0) {
                    return '<span class="badge fix_badge bg-primary p-2 px-3 rounded">' . __(\App\Models\BonDeLivraison::$statues[$bonDeLivraison->status]) . '</span>';
                } elseif ($bonDeLivraison->status == 1) {
                    return '<span class="badge fix_badge bg-info p-2 px-3 rounded">' . __(\App\Models\BonDeLivraison::$statues[$bonDeLivraison->status]) . '</span>';
                } elseif ($bonDeLivraison->status == 2) {
                    return '<span class="badge fix_badge bg-secondary p-2 px-3 rounded">' . __(\App\Models\BonDeLivraison::$statues[$bonDeLivraison->status]) . '</span>';
                } elseif ($bonDeLivraison->status == 3) {
                    return '<span class="badge fix_badge bg-warning p-2 px-3 rounded">' . __(\App\Models\BonDeLivraison::$statues[$bonDeLivraison->status]) . '</span>';
                } elseif ($bonDeLivraison->status == 4) {
                    return ' <span class="badge fix_badge bg-danger p-2 px-3 rounded">' . __(\App\Models\BonDeLivraison::$statues[$bonDeLivraison->status]) . '</span>';
                }
            })
            ->addColumn('action', function (BonDeLivraison $bonDeLivraison) {
                return view('bon_de_livraison.action', compact('bonDeLivraison'));
            });
        if (Auth::user()->type != 'client') {
            $dataTable = $dataTable->editColumn('customer_id', function (BonDeLivraison $bonDeLivraison) {
                return optional($bonDeLivraison->customer)->name ?? '';
            });
            $rowColumn[] = 'customer_id';
        }
        return $dataTable->rawColumns($rowColumn);
    }

    public function query(BonDeLivraison $model, Request $request): QueryBuilder
    {
        // Temporarily show all records for debugging
        if (Auth::user()->type != 'company') {
            $query = $model->join('users', 'bon_de_livraisons.customer_id', '=', 'users.id')
                ->where('users.id', Auth::user()->id)->select('bon_de_livraisons.*');
        } else {
            $query = $model->newQuery();
        }

        // Add workspace filter only if workspace is set
        $workspace = getActiveWorkSpace();
        if (!empty($workspace)) {
            if (Auth::user()->type != 'company') {
                $query->where('bon_de_livraisons.workspace', '=', $workspace);
            } else {
                $query->where('workspace', '=', $workspace);
            }
        }

        if (!empty($request->customer)) {
            $query->where('customer_id', '=', $request->customer);
        }
        if (!empty($request->issue_date)) {
            $date_range = explode('to', $request->issue_date);
            if (count($date_range) == 2) {
                $query->whereBetween('issue_date', $date_range);
            } else {
                $query->where('issue_date', $date_range[0]);
            }
        }

        if (!empty($request->status)) {
            $query->where('status', $request->status);
        }
        return $query->with('customers');
    }

    public function html(): HtmlBuilder
    {
        $dataTable = $this->builder()
            ->setTableId('bon-de-livraison-table')
            ->columns($this->getColumns())
            ->ajax([
                'data' => 'function(d) {
                    var issue_date = $("input[name=issue_date]").val();
                    d.issue_date = issue_date

                    var customer = $("select[name=customer]").val();
                    d.customer = customer

                    var status = $("select[name=status]").val();
                    d.status = status
                }',
            ])
            ->orderBy(0)
            ->language([
                "paginate" => [
                    "next" => '<i class="ti ti-chevron-right"></i>',
                    "previous" => '<i class="ti ti-chevron-left"></i>'
                ],
                'lengthMenu' => __("_MENU_") . __('Entries Per Page'),
                "searchPlaceholder" => __('Search...'), 
                "search" => "",
                "info" => __('Showing _START_ to _END_ of _TOTAL_ entries')
            ])
            ->initComplete('function() {
                                var table = this;

                                 $("body").on("click", "#applyfilter", function() {

                                    if (!$("input[name=issue_date]").val() && !$("select[name=customer]").val() && !$("select[name=status]").val()) {
                                        toastrs("Error!", "Please select Atleast One Filter ", "error");
                                        return;
                                    }

                                    $("#bon-de-livraison-table").DataTable().draw();
                                });

                                $("body").on("click", "#clearfilter", function() {
                                    $("input[name=issue_date]").val("")
                                    $("select[name=customer]").val("")
                                    $("select[name=status]").val("")
                                    $("#bon-de-livraison-table").DataTable().draw();
                                });

                                var searchInput = $(\'#\'+table.api().table().container().id+\' label input[type="search"]\');
                                searchInput.removeClass(\'form-control form-control-sm\');
                                searchInput.addClass(\'dataTable-input\');
                                var select = $(table.api().table().container()).find(".dataTables_length select").removeClass(\'custom-select custom-select-sm form-control form-control-sm\').addClass(\'dataTable-selector\');
                            }');

        $exportButtonConfig = [
            'extend' => 'collection',
            'className' => 'btn btn-light-secondary me-1 dropdown-toggle',
            'text' => '<i class="ti ti-download"></i> ' . __('Export'),
            'buttons' => [
                [
                    'extend' => 'print',
                    'text' => '<i class="fas fa-print"></i> ' . __('Print'),
                    'className' => 'btn btn-light text-primary dropdown-item',
                    'exportOptions' => ['columns' => [0, 1, 3]],
                ],
                [
                    'extend' => 'csv',
                    'text' => '<i class="fas fa-file-csv"></i> ' . __('CSV'),
                    'className' => 'btn btn-light text-primary dropdown-item',
                    'exportOptions' => ['columns' => [0, 1, 3]],
                ],
                [
                    'extend' => 'excel',
                    'text' => '<i class="fas fa-file-excel"></i> ' . __('Excel'),
                    'className' => 'btn btn-light text-primary dropdown-item',
                    'exportOptions' => ['columns' => [0, 1, 3]],
                ],
            ],
        ];

        $buttonsConfig = array_merge([
            $exportButtonConfig,
            [
                'extend' => 'reset',
                'className' => 'btn btn-light-danger me-1',
            ],
            [
                'extend' => 'reload',
                'className' => 'btn btn-light-warning',
            ],
        ]);

        $dataTable->parameters([
            "dom" =>  "
                            <'dataTable-top'<'dataTable-dropdown page-dropdown'l><'dataTable-botton table-btn dataTable-search tb-search  d-flex justify-content-end gap-2'Bf>>
                            <'dataTable-container'<'col-sm-12'tr>>
                            <'dataTable-bottom row'<'col-5'i><'col-7'p>>",
            'buttons' => $buttonsConfig,
            "drawCallback" => 'function( settings ) {
                                    var tooltipTriggerList = [].slice.call(
                                        document.querySelectorAll("[data-bs-toggle=tooltip]")
                                      );
                                      var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                                        return new bootstrap.Tooltip(tooltipTriggerEl);
                                      });
                                      var popoverTriggerList = [].slice.call(
                                        document.querySelectorAll("[data-bs-toggle=popover]")
                                      );
                                      var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
                                        return new bootstrap.Popover(popoverTriggerEl);
                                      });
                                      var toastElList = [].slice.call(document.querySelectorAll(".toast"));
                                      var toastList = toastElList.map(function (toastEl) {
                                        return new bootstrap.Toast(toastEl);
                                      });
                                }'
        ]);

        $dataTable->language([
            'buttons' => [
                'create' => __('Create'),
                'export' => __('Export'),
                'print' => __('Print'),
                'reset' => __('Reset'),
                'reload' => __('Reload'),
                'excel' => __('Excel'),
                'csv' => __('CSV'),
            ]
        ]);

        return $dataTable;
    }

    public function getColumns(): array
    {
        $column = [
            Column::make('id')->searchable(false)->visible(false)->exportable(false)->printable(false),
            Column::make('No')->title(__('No'))->data('DT_RowIndex')->name('DT_RowIndex')->searchable(false)->orderable(false),
            Column::make('bon_de_livraison_id')->title(__('Delivery Note')),
        ];
        if (Auth::user()->type != 'client') {
            $column[] = Column::make('customer_id')->title(__('Customer'));
        }
        $column[] = Column::make('account_type')->title(__('Account Type'));
        $column[] = Column::make('issue_date')->title(__('Issue Date'));
        $column[] = Column::make('status')->title(__('Status'));
        $column[] = Column::computed('action')
            ->exportable(false)
            ->printable(false)
            ->width(60)
            ->addClass('text-center');
        return $column;
    }

    protected function filename(): string
    {
        return 'BonDeLivraison_' . date('YmdHis');
    }
}
