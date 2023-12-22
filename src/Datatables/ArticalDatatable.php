<?php

namespace App\Datatables;

use App\Entity\Artical;
use Sg\DatatablesBundle\Datatable\AbstractDatatable;
use Sg\DatatablesBundle\Datatable\Column\ActionColumn;
use Sg\DatatablesBundle\Datatable\Column\BooleanColumn;
use Sg\DatatablesBundle\Datatable\Column\Column;
use Sg\DatatablesBundle\Datatable\Column\DateTimeColumn;
use Sg\DatatablesBundle\Datatable\Column\MultiselectColumn;
use Sg\DatatablesBundle\Datatable\Editable\SelectEditable;
use Sg\DatatablesBundle\Datatable\Filter\DateRangeFilter;
use Sg\DatatablesBundle\Datatable\Filter\TextFilter;
use Sg\DatatablesBundle\Datatable\Style;

class ArticalDatatable extends AbstractDatatable
{

    /**
     * {@inheritdoc}
     */
    public function buildDatatable(array $options = [])
    {
        $this->ajax->set([
            'pipeline' => 1,
        ]);


        $this->features->set(array(
            'processing'    => true
        ));

        $this->options->set([
            'classes'                       => 'cls-sgDatatable ' . Style::BOOTSTRAP_4_STYLE,
            'individual_filtering'          => true,
            'individual_filtering_position' => 'head',
            'order_cells_top'               => true,
            'search_in_non_visible_columns' => false,
            'order'                         => [[1, 'desc']],
        ]);

        $this->columnBuilder
            ->add(
                null,
                MultiselectColumn::class,
                [
                    'start_html'              => '<div class="start_checkboxes">',
                    'end_html'                => '</div>',
                    'value'                   => 'id',
                    'value_prefix'            => true,
                    'class_name'              => 'text-center',
                    'actions'                 => [
                        [
                            'route'           => 'bulk_delete',
                            'icon'            => 'glyphicon glyphicon-trash',
                            'label'           => 'Delete',
                            'attributes'      => [
                                'rel'         => 'tooltip',
                                'title'       => 'Delete',
                                'id'          => 'btn-bulk-delete',
                                'class'       => 'btn btn-danger btn-xs',
                                'role'        => 'button',
                            ],
                            'confirm'         => true,
                            'confirm_message' => 'Are you sure you want to delete selected item(s) ?',
                            'start_html'      => '<div class="start_delete_action">',
                            'end_html'        => '</div>',

                        ],
                    ],
                ]
            )
            ->add('id', Column::class, [
                'visible' => false,
            ])
            ->add('blogTitle', Column::class, [
                'title'  => 'Blog Title',
                'filter' => [TextFilter::class, ['classes' => 'hide']]
            ])
            ->add('authorName', Column::class, [
                'title'  => 'Author Name',
                'filter' => [TextFilter::class, ['classes' => 'hide']]
            ])
            ->add('authorEmail', Column::class, [
                'title'  => 'Author Email',
                'filter' => [TextFilter::class, ['classes' => 'hide']]
            ])
            ->add('authorMobile', Column::class, [
                'title'  => 'Author Mobile',
                'filter' => [TextFilter::class, ['classes' => 'hide']]
            ])
            ->add('dateCreated', DateTimeColumn::class, [
                'title'       => 'Reg.date',
                'date_format' => 'DD-MM-YYYY hh:mm:ss a',
                'orderable'   => true,
                'class_name'  => 'drFilter',
                'filter'      => [DateRangeFilter::class, ['classes' => 'hide']],
            ])
            ->add('blogStatus', BooleanColumn::class, [
                'title'       => 'Active',
                'class_name'  => 'text-center',
                'true_label'  => 'Y',
                'false_label' => 'N',
                'filter'      => [TextFilter::class, ['classes' => 'hide']],
                'editable'    => [
                    SelectEditable::class,
                    [
                        'source'        => [
                            [
                                'value' => Artical::_ACTIVE,
                                'text'  => Artical::_ACTIVE_LABEL
                            ],
                            [
                                'value' => Artical::_INACTIVE,
                                'text'  => Artical::_INACTIVE_LABEL
                            ],
                        ],
                        'mode'          => 'inline',
                        'empty_text'    => '',
                    ],
                ],
            ])
            ->add(null, ActionColumn::class, [
                'title'      => 'Actions',
                'start_html' => '<div class="start_actions">',
                'end_html'   => '</div>',
                'class_name' => 'text-center',
                'actions'    => [
                    [
                        'route' => 'blog_edit',
                        'label' => '',
                        'route_parameters' => [
                            'id' => 'id'
                        ],
                        "icon"       => "fas fa-edit",
                        'attributes' => [
                            'rel'    => 'tooltip',
                            'title'  => 'Edit',
                            'class'  => 'btn btn-default btn-xs margin-r-5',
                            'role'   => 'button',
                        ],
                        'start_html' => '<div class="start_show_action">',
                        'end_html'   => '</div>',
                    ],
                    [
                        'label'                => '',
                        'button'               => true,
                        'button_value_prefix'  => false,
                        "icon"                 => "fas fa-trash",
                        'attributes' => [
                            'rel'    => 'tooltip',
                            'title'  => 'Delete',
                            'class'  => 'btn btn-danger btn-xs fnConfirmRemove margin-r-5',
                            'role'   => 'button'
                        ],
                        'start_html' => '<div class="start_show_action">',
                        'end_html'   => '</div>',
                    ],
                ]
            ]);
    }

    /**
     * @return string
     */
    public function getEntity(): string
    {
        return Artical::class;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return 'artical_datatable';
    }
}