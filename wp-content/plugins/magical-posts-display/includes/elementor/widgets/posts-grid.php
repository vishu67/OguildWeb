<?php


class mgpdEPostsGrid extends \Elementor\Widget_Base
{

    /**
     * Get widget name.
     *
     * Retrieve Blank widget name.
     *
     * @return string Widget name.
     * @since 1.0.0
     * @access public
     *
     */
    public function get_name()
    {
        return 'mgposts_dgrid';
    }

    /**
     * Get widget title.
     *
     * Retrieve Blank widget title.
     *
     * @return string Widget title.
     * @since 1.0.0
     * @access public
     *
     */
    public function get_title()
    {
        return __('Magical Posts Grid', 'magical-posts-display');
    }

    /**
     * Get widget icon.
     *
     * Retrieve Blank widget icon.
     *
     * @return string Widget icon.
     * @since 1.0.0
     * @access public
     *
     */
    public function get_icon()
    {
        return 'eicon-posts-grid';
    }

    /**
     * Get widget categories.
     *
     * Retrieve the list of categories the Blank widget belongs to.
     *
     * @return array Widget categories.
     * @since 1.0.0
     * @access public
     *
     */
    public function get_categories()
    {
        return ['mgp-mgposts'];
    }

    public function get_keywords()
    {
        return ['magic', 'post', 'grid', 'card', 'category'];
    }
    /**
     * Register Blank widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function register_controls()
    {

        $this->register_content_controls();
        $this->register_style_controls();
    }

    /**
     * Register Blank widget content ontrols.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    function register_content_controls()
    {

        $this->start_controls_section(
            'mgpg_query',
            [
                'label' => esc_html__('Posts Query', 'magical-posts-display'),
            ]
        );

        $this->add_control(
            'mgpg_posts_filter',
            [
                'label' => esc_html__('Filter By', 'magical-posts-display'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'recent',
                'options' => [
                    'recent' => esc_html__('Recent Posts', 'magical-posts-display'),
                    /*'featured' => esc_html__( 'Popular Posts', 'magical-posts-display' ),*/
                    'random_order' => esc_html__('Random Posts', 'magical-posts-display'),
                    'show_byid' => esc_html__('Show By Id', 'magical-posts-display'),
                    'show_byid_manually' => esc_html__('Add ID Manually', 'magical-posts-display'),
                ],
            ]
        );

        $this->add_control(
            'mgpg_post_id',
            [
                'label' => __('Select posts', 'magical-posts-display'),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'label_block' => true,
                'multiple' => true,
                'options' => mp_display_posts_name(),
                'condition' => [
                    'mgpg_posts_filter' => 'show_byid',
                ]
            ]
        );

        $this->add_control(
            'mgpg_post_ids_manually',
            [
                'label' => __('posts IDs', 'magical-posts-display'),
                'description' => __('Separate IDs with commas', 'magical-posts-display'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'condition' => [
                    'mgpg_posts_filter' => 'show_byid_manually',
                ]
            ]
        );

        $this->add_control(
            'mgpg_posts_count',
            [
                'label'   => __('posts Limit', 'magical-posts-display'),
                'type'    => \Elementor\Controls_Manager::NUMBER,
                'default' => 6,
                'step'    => 1,
            ]
        );

        $this->add_control(
            'mgpg_grid_categories',
            [
                'label' => esc_html__('posts Categories', 'magical-posts-display'),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'label_block' => true,
                'multiple' => true,
                'options' => mp_display_taxonomy_list(),
                'condition' => [
                    'mgpg_posts_filter!' => 'show_byid',
                ]
            ]
        );

        $this->add_control(
            'mgpg_custom_order',
            [
                'label' => esc_html__('Custom order', 'magical-posts-display'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default' => '',
            ]
        );

        $this->add_control(
            'orderby',
            [
                'label' => esc_html__('Orderby', 'magical-posts-display'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'none',
                'options' => [
                    'none'          => esc_html__('None', 'magical-posts-display'),
                    'ID'            => esc_html__('ID', 'magical-posts-display'),
                    'date'          => esc_html__('Date', 'magical-posts-display'),
                    'name'          => esc_html__('Name', 'magical-posts-display'),
                    'title'         => esc_html__('Title', 'magical-posts-display'),
                    'comment_count' => esc_html__('Comment count', 'magical-posts-display'),
                    'rand'          => esc_html__('Random', 'magical-posts-display'),
                ],
                'condition' => [
                    'mgpg_custom_order' => 'yes',
                ]
            ]
        );

        $this->add_control(
            'order',
            [
                'label' => esc_html__('order', 'magical-posts-display'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'DESC',
                'options' => [
                    'DESC'  => esc_html__('Descending', 'magical-posts-display'),
                    'ASC'   => esc_html__('Ascending', 'magical-posts-display'),
                ],
                'condition' => [
                    'mgpg_custom_order' => 'yes',
                ]
            ]
        );

        $this->end_controls_section();
        // posts Content
        $this->start_controls_section(
            'mgpg_layout',
            [
                'label' => esc_html__('Grid Layout', 'magical-posts-display'),
            ]
        );
        $this->add_control(
            'mgpg_post_style',
            [
                'label'   => __('Grid Style', 'magical-posts-display'),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'default' => '1',
                'options' => [
                    '1'   => __('Style One', 'magical-posts-display'),
                    '2'  => __('Style Two', 'magical-posts-display'),
                ]
            ]
        );
        $this->add_control(
            'mgpg_rownumber',
            [
                'label'   => __('Show Posts Per Row', 'magical-posts-display'),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'default' => '4',
                'options' => [
                    '12'   => __('1', 'magical-posts-display'),
                    '6'  => __('2', 'magical-posts-display'),
                    '4'  => __('3', 'magical-posts-display'),
                    '3'  => __('4', 'magical-posts-display'),
                    '2'  => __('6', 'magical-posts-display'),
                ]
            ]
        );
        $this->end_controls_section();
        // posts Content
        $this->start_controls_section(
            'mgpg_content',
            [
                'label' => esc_html__('Content Settings', 'magical-posts-display'),
            ]
        );


        $this->add_control(
            'mgpg_post_img_show',
            [
                'label'     => __('Show Posts image', 'magical-posts-display'),
                'type'      => \Elementor\Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );
        $this->add_control(
            'mgpg_show_title',
            [
                'label'     => __('Show posts Title', 'magical-posts-display'),
                'type'      => \Elementor\Controls_Manager::SWITCHER,
                'default' => 'yes',

            ]
        );
        $this->add_control(
            'mgpg_crop_title',
            [
                'label'   => __('Crop Title By Word', 'magical-posts-display'),
                'type'    => \Elementor\Controls_Manager::NUMBER,
                'step'    => 1,
                'default' => 5,
                'condition' => [
                    'mgpg_show_title' => 'yes',
                ]

            ]
        );
        $this->add_control(
            'mgpg_title_tag',
            [
                'label' => __('Title HTML Tag', 'magical-posts-display'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'h1' => 'H1',
                    'h2' => 'H2',
                    'h3' => 'H3',
                    'h4' => 'H4',
                    'h5' => 'H5',
                    'h6' => 'H6',
                    'div' => 'div',
                    'span' => 'span',
                    'p' => 'p',
                ],
                'default' => 'h4',
                'condition' => [
                    'mgpg_show_title' => 'yes',
                ]

            ]
        );
        $this->add_control(
            'mgpg_desc_show',
            [
                'label'     => __('Show posts Description', 'magical-posts-display'),
                'type'      => \Elementor\Controls_Manager::SWITCHER,
                'default' => 'yes'

            ]
        );
        $this->add_control(
            'mgpg_crop_desc',
            [
                'label'   => __('Crop Description By Word', 'magical-posts-display'),
                'type'    => \Elementor\Controls_Manager::NUMBER,
                'step'    => 1,
                'default' => 20,
                'condition' => [
                    'mgpg_desc_show' => 'yes',
                ]

            ]
        );

        $this->add_responsive_control(
            'mgpg_content_align',
            [
                'label' => __('Alignment', 'magical-posts-display'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'magical-posts-display'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'magical-posts-display'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'magical-posts-display'),
                        'icon' => 'eicon-text-align-right',
                    ],

                ],
                'default' => 'left',
                'classes' => 'flex-{{VALUE}}',
                'selectors' => [
                    '{{WRAPPER}} .mgp-card .mg-card-text.card-body' => 'text-align: {{VALUE}};',
                ],
            ]
        );


        $this->end_controls_section();

        $this->start_controls_section(
            'mgpg_meta_section',
            [
                'label' => __('Posts Meta', 'magical-posts-display'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
                'default' => '',
            ]
        );
        $this->add_control(
            'mgpg_category_show',
            [
                'label'     => __('Show Category', 'magical-posts-display'),
                'type'      => \Elementor\Controls_Manager::SWITCHER,
                'default' => 'yes',

            ]
        );
        $this->add_control(
            'mgpg_cat_type',
            [
                'label' => __('Category type', 'magical-posts-display'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'all' => __('Show all categories', 'magical-posts-display'),
                    'one' => __('Show first category', 'magical-posts-display'),
                ],
                'default' => 'one',
                'condition' => [
                    'mgpg_category_show' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'mgpg_date_show',
            [
                'label'     => __('Show Date', 'magical-posts-display'),
                'type'      => \Elementor\Controls_Manager::SWITCHER,
                'default' => 'yes',

            ]
        );
        $this->add_control(
            'mgpg_author_show',
            [
                'label'     => __('Show Author', 'magical-posts-display'),
                'type'      => \Elementor\Controls_Manager::SWITCHER,
                'default' => 'yes',

            ]
        );
        $this->add_control(
            'mgpg_comment_icon_show',
            [
                'label'     => __('Show Comment Icon', 'magical-posts-display'),
                'type'      => \Elementor\Controls_Manager::SWITCHER,
                'default' => 'yes',

            ]
        );
        $this->add_control(
            'mgpg_tag_show',
            [
                'label'     => __('Show Tags', 'magical-posts-display'),
                'type'      => \Elementor\Controls_Manager::SWITCHER,
                'default' => '',

            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            'mgpg_button',
            [
                'label' => __('Button', 'magical-posts-display'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'mgpg_post_btn',
            [
                'label' => __('Use post link?', 'magical-posts-display'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'magical-posts-display'),
                'label_off' => __('No', 'magical-posts-display'),
                'default' => 'yes',
            ]
        );
        $this->add_control(
            'mgpg_link_type',
            [
                'label' => __('Link type', 'magical-posts-display'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'link1' => 'Link style one',
                    'btn btn-outline-dark' => 'Link style two',
                    'btn btn-info' => 'Button',
                ],
                'default' => 'link1',
            ]
        );

        $this->add_control(
            'mgpg_btn_title',
            [
                'label'       => __('Link Title', 'magical-posts-display'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'input_type'  => 'text',
                'placeholder' => __('Read More', 'magical-posts-display'),
                'default'     => __('Read More', 'magical-posts-display'),
            ]
        );
        $this->add_control(
            'mgpg_btn_target',
            [
                'label' => __('Link Target', 'magical-posts-display'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    '_self' => 'self',
                    '_blank' => 'Blank',
                ],
                'default' => '_self',
            ]
        );

        $this->add_control(
            'mgpg_usebtn_icon',
            [
                'label' => __('Use icon', 'magical-posts-display'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'magical-posts-display'),
                'label_off' => __('No', 'magical-posts-display'),
                'default' => '',
            ]
        );

        $this->add_control(
            'mgpg_btn_icon',
            [
                'label' => __('Choose Icon', 'magical-posts-display'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-chevron-right',
                    'library' => 'solid',
                ],
                'condition' => [
                    'mgpg_usebtn_icon' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'mgpg_btn_icon_position',
            [
                'label' => __('Icon Position', 'magical-posts-display'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'magical-posts-display'),
                        'icon' => 'fas fa-arrow-left',
                    ],
                    'right' => [
                        'title' => __('Right', 'magical-posts-display'),
                        'icon' => 'fas fa-arrow-right',
                    ],

                ],
                'default' => 'right',
                'condition' => [
                    'mgpg_usebtn_icon' => 'yes',
                ],

            ]
        );
        $this->add_responsive_control(
            'mgpg_cardbtn_iconspace',
            [
                'label' => __('Icon Spacing', 'magical-posts-display'),
                'type' => Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],

                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 5,
                ],
                'condition' => [
                    'mgpg_usebtn_icon' => 'yes',
                ],
                'selectors' => [
                    '{{WRAPPER}} .mg-card .mp-post-btn i.left,{{WRAPPER}} .mg-card .mp-post-btn .left i' => 'margin-right: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .mg-card .mp-post-btn i.right, {{WRAPPER}} .mg-card .mp-post-btn .right i' => 'margin-left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'mgpl_gopro',
            [
                'label' => esc_html__('Upgrade Pro', 'magical-posts-display'),
            ]
        );
        $this->add_control(
            'mgpl__pro',
            [
                'type' => \Elementor\Controls_Manager::RAW_HTML,
                'raw' => mp_go_pro_template([
                    'title' => esc_html__('Get All Pro Features', 'elementor'),
                    'massage' => esc_html__('Posts Video, QR Code, Reading Time Calculator, Total Word Count, Share Icons, Pagination And More style & options waiting for you. So upgrade pro today!! it\'s lifetime Deal!!!', 'magical-posts-display'),
                    'link' => 'https://wpthemespace.com/product/magical-posts-display-lifetime/',
                ]),
            ]
        );
        $this->end_controls_section();
    }

    /**
     * Register Blank widget style ontrols.
     *
     * Adds different input fields in the style tab to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function register_style_controls()
    {

        $this->start_controls_section(
            'mgpg_style',
            [
                'label' => __('Layout style', 'magical-posts-display'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'mgpg_padding',
            [
                'label' => __('Padding', 'magical-posts-display'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .mg-card.mgp-card' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'mgpg_margin',
            [
                'label' => __('Margin', 'magical-posts-display'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .mg-card.mgp-card' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'mgpg_bg_color',
                'label' => esc_html__('Background', 'magical-posts-display'),
                'types' => ['classic', 'gradient'],

                'selector' => '{{WRAPPER}} .mg-card.mgp-card',
            ]
        );

        $this->add_control(
            'mgpg_border_radius',
            [
                'label' => __('Radius', 'magical-posts-display'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .mg-card.mgp-card' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],

            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'mgpg_content_border',
                'selector' => '{{WRAPPER}} .mg-card.mgp-card',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'mgpg_content_shadow',
                'selector' => '{{WRAPPER}} .mg-card.mgp-card',
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'mgpg_img_style',
            [
                'label' => __('Image style', 'magical-posts-display'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'mgpg_post_img_show' => 'yes',
                ]
            ]
        );
        $this->add_responsive_control(
            'image_width_set',
            [
                'label' => __('Width', 'magical-posts-display'),
                'type' =>  \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['%', 'px'],
                'desktop_default' => [
                    'unit' => '%',
                ],
                'tablet_default' => [
                    'unit' => '%',
                ],
                'mobile_default' => [
                    'unit' => '%',
                ],
                'range' => [
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 1,
                        'max' => 1000,
                    ],

                ],
                'selectors' => [
                    '{{WRAPPER}} .mgp-card .mp-post-img figure img' => 'flex: 0 0 {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',

                ],
            ]
        );

        $this->add_responsive_control(
            'mgpg_img_auto_height',
            [
                'label' => __('Image auto height', 'magical-posts-display'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('On', 'magical-posts-display'),
                'label_off' => __('Off', 'magical-posts-display'),
                'default' => '',
            ]
        );
        $this->add_responsive_control(
            'mgpg_img_height',
            [
                'label' => __('Image Height', 'magical-posts-display'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ]
                ],
                'condition' => [
                    'mgpg_img_auto_height!' => 'yes',
                ],
                'selectors' => [
                    '{{WRAPPER}} .mgp-card .mp-post-img figure img' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'mgpg_imgbg_height',
            [
                'label' => __('Image div Height', 'magical-posts-display'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1,
                    ]
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 250,
                ],
                'condition' => [
                    'mgpg_img_auto_height!' => 'yes',
                ],
                'selectors' => [
                    '{{WRAPPER}} .mgp-card .mp-post-img figure' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'mgpg_img_padding',
            [
                'label' => __('Padding', 'magical-posts-display'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .mgp-card .mp-post-img figure img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'mgpg_img_margin',
            [
                'label' => __('Margin', 'magical-posts-display'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .mgp-card .mp-post-img figure' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'mgpg_img_border_radius',
            [
                'label' => __('Border Radius', 'magical-posts-display'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .mgp-card .mp-post-img figure img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],

            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'mgpg_img_bgcolor',
                'label' => esc_html__('Background', 'magical-posts-display'),
                //'types' => [ 'classic', 'gradient' ],

                'selector' => '{{WRAPPER}} .mgp-card .mp-post-img figure img',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'mgpg_img_border',
                'selector' => '{{WRAPPER}} .mgp-card .mp-post-img figure img',
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'mgpg_title_style',
            [
                'label' => __('posts Title', 'magical-posts-display'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'mgpg_title_padding',
            [
                'label' => __('Padding', 'magical-posts-display'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .mgp-card .mgp-ptitle' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'mgpg_title_margin',
            [
                'label' => __('Margin', 'magical-posts-display'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .mgp-card .mgp-ptitle' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'mgpg_title_color',
            [
                'label' => __('Text Color', 'magical-posts-display'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mgp-card a.mgp-title-link, {{WRAPPER}} .mgp-card .mgp-ptitle' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'mgpg_title_bgcolor',
            [
                'label' => __('Background Color', 'magical-posts-display'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mgp-card .mgp-ptitle' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'mgpg_descb_radius',
            [
                'label' => __('Border Radius', 'magical-posts-display'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .mgp-card .mgp-ptitle' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'mgpg_title_typography',
                'label' => __('Typography', 'magical-posts-display'),
                'selector' => '{{WRAPPER}} .mgp-card .mgp-ptitle',
                'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_3,
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'mgpg_description_style',
            [
                'label' => __('Description', 'magical-posts-display'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'mgpg_description_padding',
            [
                'label' => __('Padding', 'magical-posts-display'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .mgp-card .mg-card-text.card-body p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'mgpg_description_margin',
            [
                'label' => __('Margin', 'magical-posts-display'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .mgp-card .mg-card-text.card-body p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'mgpg_description_color',
            [
                'label' => __('Text Color', 'magical-posts-display'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mgp-card .mg-card-text.card-body p' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'mgpg_description_bgcolor',
            [
                'label' => __('Background Color', 'magical-posts-display'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mgp-card .mg-card-text.card-body p' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'mgpg_description_radius',
            [
                'label' => __('Border Radius', 'magical-posts-display'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .mgp-card .mg-card-text.card-body p' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'mgpg_description_typography',
                'label' => __('Typography', 'magical-posts-display'),
                'selector' => '{{WRAPPER}} .mgp-card .mg-card-text.card-body p',
                'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_3,
            ]
        );

        $this->end_controls_section();
        $this->start_controls_section(
            'mgpg_meta_style',
            [
                'label' => __('Posts Meta', 'magical-posts-display'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'mgpg_meta_cat',
            [
                'label' => __('Category style', 'magical-posts-display'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'mgpg_category_show' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'mgpg_meta_cat_margin',
            [
                'label' => __('Margin', 'magical-posts-display'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .mp-post-cat' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'mgpg_category_show' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'mgpg_meta_cat_color',
            [
                'label' => __('Text Color', 'magical-posts-display'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mp-post-cat, {{WRAPPER}} .mp-post-cat a' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'mgpg_category_show' => 'yes',
                ],
            ]
        );


        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'mgpg_meta_cat_typography',
                'label' => __('Typography', 'magical-posts-display'),
                'selector' => '{{WRAPPER}} .mp-post-cat, {{WRAPPER}} .mp-post-cat a',
                'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_3,
                'condition' => [
                    'mgpg_category_show' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'mgpg_meta_author',
            [
                'label' => __('Posts Author', 'magical-posts-display'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'mgpg_author_show' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'mgpg_meta_author_margin',
            [
                'label' => __('Margin', 'magical-posts-display'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .mp-meta .byline' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'mgpg_author_show' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'mgpg_meta_author_color',
            [
                'label' => __('Text Color', 'magical-posts-display'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mp-meta .byline i, {{WRAPPER}} .mp-meta .byline a' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'mgpg_author_show' => 'yes',
                ],
            ]
        );


        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'mgpg_meta_author_typography',
                'label' => __('Typography', 'magical-posts-display'),
                'selector' => '{{WRAPPER}} .mp-meta .byline a',
                'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_3,
                'condition' => [
                    'mgpg_author_show' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'mgpg_meta_date',
            [
                'label' => __('Date Style', 'magical-posts-display'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'mgpg_date_show' => 'yes',
                ],
            ]
        );
        $this->add_responsive_control(
            'mgpg_meta_date_margin',
            [
                'label' => __('Margin', 'magical-posts-display'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .mgp-time,{{WRAPPER}} .mp-posts-date' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'mgpg_date_show' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'mgpg_meta_date_color',
            [
                'label' => __('Text Color', 'magical-posts-display'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mgp-time, {{WRAPPER}} .mgp-time i,{{WRAPPER}} .mp-posts-date,{{WRAPPER}} .mp-posts-date i' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'mgpg_date_show' => 'yes',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'mgpg_meta_date_typography',
                'label' => __('Typography', 'magical-posts-display'),
                'selector' => '{{WRAPPER}} .mp-posts-date,{{WRAPPER}} .mgp-time',
                'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_3,
                'condition' => [
                    'mgpg_date_show' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'mgpg_meta_tag',
            [
                'label' => __('Tags style', 'magical-posts-display'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'mgpg_tag_show' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'mgpg_meta_tag_margin',
            [
                'label' => __('Margin', 'magical-posts-display'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .mpg-tags-links' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'mgpg_tag_show' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'mgpg_meta_tag_color',
            [
                'label' => __('Text Color', 'magical-posts-display'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mpg-tags-links a, {{WRAPPER}} .mpg-tags-links i' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'mgpg_tag_show' => 'yes',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'mgpg_meta_tag_typography',
                'label' => __('Typography', 'magical-posts-display'),
                'selector' => '{{WRAPPER}} .mpg-tags-links a',
                'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_3,
                'condition' => [
                    'mgpg_date_show' => 'yes',
                ],
            ]
        );


        $this->end_controls_section();

        $this->start_controls_section(
            'mgpg_btn_style',
            [
                'label' => __('Button', 'magical-posts-display'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'mgpg_btn_padding',
            [
                'label' => __('Padding', 'magical-posts-display'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .mgp-card a.mp-post-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
            ]
        );
        $this->add_responsive_control(
            'mgpg_btn_margin',
            [
                'label' => __('Margin', 'magical-posts-display'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .mgp-card a.mp-post-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'mgpg_btn_typography',
                'selector' => '{{WRAPPER}} .mgp-card a.mp-post-btn',
                'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_4,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'mgpg_btn_border',
                'selector' => '{{WRAPPER}} .mgp-card a.mp-post-btn',
            ]
        );

        $this->add_control(
            'mgpg_btn_border_radius',
            [
                'label' => __('Border Radius', 'magical-posts-display'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .mgp-card a.mp-post-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'mgpg_btn_box_shadow',
                'selector' => '{{WRAPPER}} .mgp-card a.mp-post-btn',
            ]
        );
        $this->add_control(
            'mgpg_button_color',
            [
                'label' => __('Button color', 'magical-posts-display'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->start_controls_tabs('mgpg_btn_tabs');

        $this->start_controls_tab(
            'mgpg_btn_normal_style',
            [
                'label' => __('Normal', 'magical-posts-display'),
            ]
        );

        $this->add_control(
            'mgpg_btn_color',
            [
                'label' => __('Text Color', 'magical-posts-display'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .mgp-card a.mp-post-btn' => 'color: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_control(
            'mgpg_btn_bg_color',
            [
                'label' => __('Background Color', 'magical-posts-display'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mgp-card a.mp-post-btn' => 'background-color: {{VALUE}} !important;',
                ],
            ]
        );


        $this->end_controls_tab();

        $this->start_controls_tab(
            'mgpg_btn_hover_style',
            [
                'label' => __('Hover', 'magical-posts-display'),
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'mgpg_btnhover_boxshadow',
                'selector' => '{{WRAPPER}} .mgp-card a.mp-post-btn:hover',
            ]
        );

        $this->add_control(
            'mgpg_btn_hcolor',
            [
                'label' => __('Text Color', 'magical-posts-display'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mgp-card a.mp-post-btn:hover, {{WRAPPER}} .mgp-card a.mp-post-btn:focus' => 'color: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_control(
            'mgpg_btn_hbg_color',
            [
                'label' => __('Background Color', 'magical-posts-display'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mgp-card a.mp-post-btn:hover, {{WRAPPER}} .mgp-card a.mp-post-btn:focus' => 'background-color: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_control(
            'mgpg_btn_hborder_color',
            [
                'label' => __('Border Color', 'magical-posts-display'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'condition' => [
                    'mgpg_btn_border_border!' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .mgp-card a.mp-post-btn:hover, {{WRAPPER}} .mgp-card a.mp-post-btn:focus' => 'border-color: {{VALUE}} !important;',
                ],
            ]
        );


        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();
    }

    /**
     * Render Blank widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render()
    {



        $settings = $this->get_settings_for_display();
        $mgpg_filter = $this->get_settings('mgpg_posts_filter');
        $mgpg_posts_count = $this->get_settings('mgpg_posts_count');
        $mgpg_custom_order = $this->get_settings('mgpg_custom_order');
        $mgpg_grid_categories = $this->get_settings('mgpg_grid_categories');
        $orderby = $this->get_settings('orderby');
        $order = $this->get_settings('order');


        // Query Argument
        $args = array(
            'post_type'             => 'post',
            'post_status'           => 'publish',
            'ignore_sticky_posts'   => 1,
            'posts_per_page'        => $mgpg_posts_count,
        );

        switch ($mgpg_filter) {


            case 'featured':
                $args['tax_query'][] = array(
                    'taxonomy' => 'product_visibility',
                    'field'    => 'name',
                    'terms'    => 'featured',
                    'operator' => 'IN',
                );
                break;

            case 'random_order':
                $args['orderby']    = 'rand';
                break;

            case 'show_byid':
                $args['post__in'] = $settings['mgpg_post_id'];
                break;

            case 'show_byid_manually':
                $args['post__in'] = explode(',', $settings['mgpg_post_ids_manually']);
                break;

            default: /* Recent */
                $args['orderby']    = 'date';
                $args['order']      = 'desc';
                break;
        }

        // Custom Order
        if ($mgpg_custom_order == 'yes') {
            $args['orderby'] = $orderby;
            $args['order'] = $order;
        }

        if (!(($mgpg_filter == "show_byid") || ($mgpg_filter == "show_byid_manually"))) {

            $post_cats = str_replace(' ', '', $mgpg_grid_categories);
            if ("0" != $mgpg_grid_categories) {
                if (is_array($post_cats) && count($post_cats) > 0) {
                    $field_name = is_numeric($post_cats[0]) ? 'term_id' : 'slug';
                    $args['tax_query'][] = array(
                        array(
                            'taxonomy' => 'category',
                            'terms' => $post_cats,
                            'field' => $field_name,
                            'include_children' => false
                        )
                    );
                }
            }
        }



        //grid layout
        $mgpg_post_style = $this->get_settings('mgpg_post_style');
        $mgpg_rownumber = $this->get_settings('mgpg_rownumber');
        // grid content
        $mgpg_post_img_show = $this->get_settings('mgpg_post_img_show');
        $mgpg_show_title = $this->get_settings('mgpg_show_title');
        $mgpg_crop_title = $this->get_settings('mgpg_crop_title');
        $mgpg_title_tag = $this->get_settings('mgpg_title_tag');
        $mgpg_desc_show = $this->get_settings('mgpg_desc_show');
        $mgpg_crop_desc = $this->get_settings('mgpg_crop_desc');
        $mgpg_post_btn = $this->get_settings('mgpg_post_btn');
        $mgpg_category_show = $this->get_settings('mgpg_category_show');
        $mgpg_usebtn_icon = $this->get_settings('mgpg_usebtn_icon');
        $mgpg_btn_title = $this->get_settings('mgpg_btn_title');
        $mgpg_btn_target = $this->get_settings('mgpg_btn_target');
        $mgpg_btn_icon = $this->get_settings('mgpg_btn_icon');
        $mgpg_btn_icon_position = $this->get_settings('mgpg_btn_icon_position');



        $mgpg_posts = new WP_Query($args);

        if ($mgpg_posts->have_posts()) :
?>
            <div id="mgp-items" class="mgpd mgp-items style<?php echo esc_attr($mgpg_post_style); ?>">
                <div class="row" data-masonry='{"percentPosition": true }'>
                    <?php while ($mgpg_posts->have_posts()) : $mgpg_posts->the_post(); ?>
                        <div class="col-lg-<?php echo esc_attr($mgpg_rownumber); ?>">
                            <div class="card mg-card mg-shadow mgp-card mb-4">
                                <?php mp_post_thumbnail($mgpg_post_img_show); ?>
                                <div class="mg-card-text card-body">
                                    <?php
                                    mp_post_cat_display($settings['mgpg_category_show'], $settings['mgpg_cat_type'], ', ');
                                    ?>

                                    <?php
                                    mp_post_title($mgpg_show_title, $mgpg_title_tag, $mgpg_crop_title);
                                    ?>
                                    <?php
                                    if ($mgpg_post_style == '1') {
                                        mpd_posts_meta($settings['mgpg_author_show'], $settings['mgpg_date_show'], $settings['mgpg_comment_icon_show']);
                                    }
                                    ?>
                                    <?php if ($mgpg_desc_show) : ?>
                                        <p><?php
                                            if (has_excerpt()) {
                                                echo wp_trim_words(get_the_excerpt(), $mgpg_crop_desc, '...');
                                            } else {
                                                echo wp_trim_words(get_the_content(), $mgpg_crop_desc, '...');
                                            }
                                            ?></p>
                                    <?php endif; ?>


                                    <?php
                                    if ($mgpg_post_btn) {
                                        mp_post_btn(
                                            $text = $mgpg_btn_title,
                                            $icon_show = $mgpg_usebtn_icon,
                                            $icon = $settings['mgpg_btn_icon'],
                                            $icon_position = $mgpg_btn_icon_position,
                                            $target = $mgpg_btn_target,
                                            $class = $settings['mgpg_link_type']
                                        );
                                    }

                                    if ($mgpg_post_style == '2') {
                                        mpd_posts_meta_author_date($settings['mgpg_author_show'], $settings['mgpg_date_show']);
                                    }

                                    mpd_post_tags($settings['mgpg_tag_show']);

                                    ?>
                                </div>

                            </div>
                        </div>
                    <?php
                    endwhile;
                    wp_reset_query();
                    wp_reset_postdata();
                    ?>
                </div>
            </div>

<?php
        endif;
    }
}
