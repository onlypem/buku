<?php

namespace App\DataTables;

use App\Models\Buku;
use App\Models\BukuDataTable;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class BukuDataTables extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addIndexColumn()
            ->editColumn('foto', function($data) {
                if ($data->foto) {
                    return '<img src="'. url(Storage::url($data->foto)) .'" class="" style="width:50px;"></img>';
                }
            })
            ->addColumn('action', function($data) {
                return "
                    <div class='d-flex justify-content-center align-items-start'>
                        <a href='" . route('buku.edit', $data->id) . "' class='btn btn-sm btn-warning me-1' style='padding: 8px 12px;font-size: 14px;font-weight: normal;'>
                        <i class='mdi mdi-pencil align-middle font-size-12'></i> Edit
                        </a>
                        <form action='" . route('buku.destroy', $data->id) . "' method='post' style='display: inline-block;'>
                            " . csrf_field() . "
                            " . method_field('DELETE') . "
                            <button type='button' class='btn btn-sm btn-danger buttonDeletion'>
                                <i class='mdi mdi-trash-can align-middle font-size-12'></i> Hapus
                            </button>
                        </form>
                    </div>
                ";
            })
            ->rawColumns(['action', 'foto']);
    }


    /**
     * Get the query source of dataTable.
     */
    public function query(Buku $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('bukudatatables-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->buttons([
                        Button::make('excel'),
                        Button::make('csv'),
                        Button::make('pdf'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::computed('DT_RowIndex', 'No')->width("10px"),
            Column::make('id')->hidden(),
            Column::make('buku'),
            Column::make('foto'),
            Column::make('created_at')->hidden(),
            Column::make('updated_at')->hidden(),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'BukuDataTables_' . date('YmdHis');
    }
}
