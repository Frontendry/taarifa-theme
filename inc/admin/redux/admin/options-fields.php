<?php

    /* Branding */
    Redux::setSection( $opt_name , array(
        'icon'      => 'el el-picture',
        'id'        => 'branding-section',
        'title'     => esc_html__( 'Identity', 'taarifa' ),
        'desc'      => esc_html__( 'Brand your theme by adding your own logo.', 'taarifa' ),
        'fields'    => array(
            array(
                'id'        => 'main-logo',
                'type'      => 'media',
                'url'       => true,
                'title'     => esc_html__( 'Logo', 'taarifa' ),
                'subtitle'  => esc_html__( 'Upload your logo image here, or leave empty to show the site title instead.', 'taarifa' ),
                'default'   => array( 'url' => esc_url( get_template_directory_uri().'/assets/images/taarifa-logo.png' ) ),
            ),

            array(
                'id'        => 'main-logo-custom-url',
                'type'      => 'text',
                'title'     => esc_html__( 'Custom logo URL', 'taarifa' ),
                'subtitle'  => esc_html__( 'Optionally, specify custom URL if you want logo to point out to some other page/website instead of your home page', 'taarifa' ),
                'default'   => ''
            )
        )
    ) );

    /* Header */
    Redux::setSection( $opt_name , array(
        'id'        => 'header-section',
        'icon'      => 'el el-arrow-up',
        'title'     => esc_html__( 'Header', 'taarifa' ),
        'desc'      => esc_html__( 'Modify your header to what you love.', 'taarifa' ),
        'fields'    => array(
            array(
                'id'       => 'header-layout',
                'type'     => 'image_select',
                'title'    => esc_html__( 'Header layout', 'taarifa' ),
                'subtitle' =>   wp_kses_post( sprintf( __( 'Choose a header for your layout. Below are the meanings of the abbreviations used on the options below: <br/><br/>LO - Logo <br/>NA - Navigation <br/>SE - Search Icon <br/>SO - Social Icons <br/>NE - Newsletter Signup Icon', 'taarifa' ) ) ),
                'options' => array(
                    'default' => array(
                        'title' => esc_html__( 'Default', 'taarifa' ), 
                        'img'   => get_template_directory_uri() . '/assets/images/admin/header-default.png'
                    ),
                    'logo-out' => array(
                        'title' => esc_html__( 'Logo Out', 'taarifa' ), 
                        'img'   => get_template_directory_uri() . '/assets/images/admin/header-logo-out.png'
                    ),
                    'nav-out'      => array(
                        'title' => esc_html__( 'Nav Out', 'taarifa' ), 
                        'img'  => get_template_directory_uri() . '/assets/images/admin/header-nav-out.png'
                    )                    
                ),               
                'default' => 'default'
            )
            
        )         
    )  );

    /* Posts Layouts */
    Redux::setSection( $opt_name , array(
        'icon'      => 'el el-align-center',
        'id'        => 'posts-page-structure-section',
        'title'     => esc_html__( 'Posts Page Structure', 'taarifa' ),
        'fields'    => array(
            array(
                'id'        => 'posts-layout-section',
                'type'      => 'section',
                'title'    => esc_html__( 'Posts layout', 'taarifa' ),
                'indent'   => false
            ),
            array(
                'id'       => 'posts-layout-options',
                'type'     => 'image_select', 
                'title' => false,               
                'subtitle' =>   wp_kses_post( sprintf( __( 'Choose a post layout in the image options below. Please note: <br/> <br/>
                <p>Masonry Grid Layout - Works with both featured & no-featured image posts.</p>
                <p>List Layout A - Works with both featured & no-featured image posts.</p>
                <p>List Layout B - Works with only featured image posts.</p>
                <p>List Layout C - Works with only featured image posts.</p>', 
                'taarifa' ) ) ),
                'options' => array(
                    'masonry-grid-layout' => array(
                        'title' => esc_html__( 'Masonry Grid', 'taarifa' ), 
                        'img'   => get_template_directory_uri() . '/assets/images/admin/header-default.png'
                    ),
                    'list-layout-a' => array(
                        'title' => esc_html__( 'List Layout A', 'taarifa' ), 
                        'img'   => get_template_directory_uri() . '/assets/images/admin/header-logo-out.png'
                    ),
                    'list-layout-b' => array(
                        'title' => esc_html__( 'List Layout B', 'taarifa' ), 
                        'img'  => get_template_directory_uri() . '/assets/images/admin/header-nav-out.png'
                    ),
                    'list-layout-c' => array(
                        'title' => esc_html__( 'List Layout C', 'taarifa' ), 
                        'img'  => get_template_directory_uri() . '/assets/images/admin/header-nav-out.png'
                    )                     
                ),               
                'default' => 'masonry-grid-layout'
            ),
            array(
                'id'        => 'pagination-layout-section',
                'type'      => 'section',
                'title'    => esc_html__( 'Pagination layout', 'taarifa' ),
                'indent'   => false
            ),   
            array(
                'id'       => 'pagination-layout-options',
                'type'     => 'radio', 
                'title' => false,               
                'subtitle' =>   wp_kses_post( sprintf( __( 'Choose a pagination layout below.', 
                'taarifa' ) ) ),
                'options' => array(
                    'load-more-button' => esc_html__( 'Load more button', 'taarifa' ),
                    'prev-next-pagination' => esc_html__( 'Previous/next pagination', 'taarifa' ),
                    'numbered-pagination' => esc_html__( 'Numbered pagination', 'taarifa' ),'both-prev-next-and-numbered-pagination' => esc_html__( 'Both numbered and previous/next paginations ', 'taarifa' )                                        
                ),               
                'default' => 'load-more-button'
            ), 
            array(
                'id'       => 'more-posts-text',
                'type'     => 'text',
                'title'    => __( 'More posts text', 'taarifa' ),
                'subtitle' =>   wp_kses_post( sprintf( __( 'Enter the &apos;more posts&apos; text that you would prefer on the field below. The default text is <em>"More posts"</em>.', 'taarifa' ) ) ),
                'validate' => 'no_html',
                'default'  => 'More posts',
                'required' => array( 'pagination-layout-options','equals','load-more-button' )
                
            ),
            array(
                'id'       => 'loading-text',
                'type'     => 'text',
                'title'    => __( 'Loading text', 'taarifa' ),
                'subtitle' =>   wp_kses_post( sprintf( __( 'Enter the &apos;Loading...&apos; text that you would prefer on the field below. The default text is <em>"Loading..."</em>.', 'taarifa' ) ) ),
                'validate' => 'no_html',
                'default'  => 'Loading...',
                'required' => array( 'pagination-layout-options','equals','load-more-button' )
                
            )      
        )
    ) );

    /* Post Settings */
    Redux::setSection( $opt_name, array(
        'id'        => 'post-settings-section',
        'icon'      => 'el el-adjust-alt',
        'title'     => esc_html__( 'Post settings', 'taarifa' ),
        'heading' => false              
    ) );

    /* Posts Page Settings */
    Redux::setSection( $opt_name, array(
        'id'        => 'landing-page-settings-section',
        'icon'      => 'el el-align-center',
        'title'     => esc_html__( 'Posts page settings', 'taarifa' ),
        'desc'      => esc_html__( 'Manage different options for the posts page.', 'taarifa' ),
        'subsection' => true,
        'fields'    => array(            
            array(
                'id'       => 'display-pattern',
                'type'     => 'switch',
                'title'    => esc_html__( 'Display pattern', 'taarifa' ),
                'subtitle' => esc_html__( 'Choose whether or not to display patterns on your posts.', 'taarifa' ),
                'default' => true
            ),
            array(
                'id'       => 'enable-animations',
                'type'     => 'switch',
                'title'    => esc_html__( 'Enable animations', 'taarifa' ),
                'subtitle' =>   esc_html__( 'Choose whether or not to enable "fade up" animation on your posts.', 'taarifa' ),
                'default' => true
            ),
            array(
                'id'       => 'readmore-text',
                'type'     => 'text',
                'title'    => __('Read more text', 'taarifa'),
                'subtitle' =>   wp_kses_post( sprintf( __( 'Enter the &apos;read more&apos; text that you would prefer on the field below. The default text is <em>"Read More"</em>.', 'taarifa' ) ) ),
                'validate' => 'no_html',
                'default'  => 'Read More'
            )
        )        
    ) );

    /* Single Post Settings */
    Redux::setSection( $opt_name, array(
        'id'        => 'single-post-settings-section',
        'icon'      => 'el el-file',
        'title'     => esc_html__( 'Single post settings', 'taarifa' ),
        'desc'      => esc_html__( 'Manage different options for a single post.', 'taarifa' ),
        'subsection' => true,
        'fields'    => array( 
            array(
                'id'       => 'you-are-reading-text',
                'type'     => 'text',
                'title'    => __('You are reading text', 'taarifa'),
                'subtitle' =>   wp_kses_post( sprintf( __( 'Enter the &apos;you are reading&apos; text that you would prefer on the field below. The default text is <em>"You are reading"</em>.', 'taarifa' ) ) ),
                'validate' => 'no_html',
                'default'  => 'You are reading'
            ),
            array(
                'id'       => 'view-all-photos-text',
                'type'     => 'text',
                'title'    => __('View all photos text', 'taarifa'),
                'subtitle' =>   wp_kses_post( sprintf( __( 'Enter the &apos;view all photos&apos; text that you would prefer to be displayed on a gallery post. The default text is <em>"View all photos"</em>.', 'taarifa' ) ) ),
                'validate' => 'no_html',
                'default'  => 'View all photos'
            ),
            array(
                'id'       => 'back-to-post-text',
                'type'     => 'text',
                'title'    => __('Back to post text', 'taarifa'),
                'subtitle' =>   wp_kses_post( sprintf( __( 'Enter the &apos;back to post&apos; text that you would prefer to be displayed on the gallery modal. The default text is <em>"Back to post"</em>.', 'taarifa' ) ) ),
                'validate' => 'no_html',
                'default'  => 'Back to post'
            ),
            array(
                'id'        => 'posts_social_opts',
                'type'      => 'sortable',
                'mode'      => 'checkbox',
                'title'     => esc_html__( 'Social share options', 'taarifa' ),
                'subtitle' =>   wp_kses_post( sprintf( __( 'Check and re-order which social links you want to display. <em>Keep the options at a minimal level to reduce clutter.</em>', 'taarifa' ) ) ),                
                'options'   => array(
                    'facebook' => 'Facebook',
                    'twitter' => 'Twitter',                    
                    'googleplus' => 'Google Plus',
                    'linkedin' => 'LinkedIn',
                    'pinterest' => 'Pinterest',
                    'email' => 'Email',
                    'vk' => 'VK',
                    'digg' => 'Digg',
                    'reddit' => 'Reddit',
                    'stumbleupon' => 'StumbleUpon',
                    'tumblr' => 'Tumblr',                    
                    'whatsapp' => 'WhatsApp(Viewable on mobile only)',
                    'telegram' => 'Telegram(Viewable on mobile only)',
                ),
                'default' => array(
                    'facebook' => '1',
                    'twitter' => '1',                    
                    'googleplus' => '0',
                    'linkedin' => '1',
                    'pinterest' => '0',
                    'email' => '0',
                    'vk' => '0',
                    'digg' => '0',
                    'reddit' => '0',
                    'stumbleupon' => '0',
                    'tumblr' => '0',
                    'whatsapp' => '0',
                    'telegram' => '0',
                ),
            ),

        )        
    ) );

   


?>