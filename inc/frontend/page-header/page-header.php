<?php
if ( ! function_exists( 'valkiriapps_page_header' ) ) {
    function valkiriapps_page_header () {
        $pheader = '';
        if ( function_exists('rwmb_meta') ) {
            $pheader = rwmb_meta('pheader_switch');
            if ( is_home() || is_archive() || is_search() || is_singular('post') ){
                $pheader = rwmb_meta('pheader_switch', "type=switch", get_option( 'page_for_posts' ));
            }
            if ( class_exists( 'woocommerce' ) ) {
                if ( is_shop() || is_product_category() || is_product_tag() || is_product() ) {
                    $pheader = rwmb_meta('pheader_switch', "type=switch", get_option( 'woocommerce_shop_page_id' ));
                }
            }
            if ( !$pheader ) {
                return;
            }
        }
        if ( !valkiriapps_get_option('pheader_switch') && !$pheader ) {
            return;
        } else {
            $bg     = '';
            $title  = '';
            $output = array();

            if ( is_home() ) {
                $title = get_the_title(get_option('page_for_posts'));
            } elseif ( is_search() ) {
                $title = esc_html__('Search Results for: ', 'valkiriapps') . get_search_query();
            } elseif ( is_archive() ) {
                $title = get_the_archive_title();
            } elseif ( is_singular('post') ) {
                $title = valkiriapps_get_option( 'ptitle_post' ) ? valkiriapps_get_option( 'ptitle_post' ) : get_the_title();
            } else {
                $title = get_the_title();
            }
            
            if ( !function_exists( 'rwmb_meta' ) ) {
                $bg = valkiriapps_get_option( 'pheader_img' );
            } else {
                if ( is_home() ) {
                    $images = rwmb_meta('pheader_bg_image', "type=image", get_option( 'page_for_posts' ));
                } elseif ( class_exists( 'woocommerce' ) && is_shop() ){
                    $images = rwmb_meta('pheader_bg_image', "type=image", get_option( 'woocommerce_shop_page_id' ));
                } else {
                    $images = rwmb_meta('pheader_bg_image', "type=image");
                }
                if ( !$images ) {
                    $bg = valkiriapps_get_option( 'pheader_img' );
                } else {
                    foreach ($images as $image) {
                        $bg = $image['full_url'];
                        break;
                    }
                }
            }

            if ( $title ) {
                $output[] = sprintf('%s', $title);
            }

            $htmltag = ( !empty( valkiriapps_get_option( 'pheader_htmltag' ) ) ? valkiriapps_get_option( 'pheader_htmltag' ) : 'h1');
            
        ?>        
            <div class="page-header flex-middle" <?php if ($bg) { ?> style="background-image: url(<?php echo esc_url($bg); ?>);" <?php } ?>>
                <div class="container">
                    <div class="inner <?php if ( !valkiriapps_get_option( 'left_bread' ) ) echo 'flex-middle'; ?>">
                        <?php if ( class_exists( 'woocommerce' ) && is_woocommerce() ) { ?>
                            <?php if ( !is_product() ) { ?>
                                <?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
                                    <<?php echo $htmltag; ?> class="woocommerce-products-header__title page-title"><?php woocommerce_page_title(); ?></<?php echo $htmltag; ?>>
                                <?php endif; ?>                            
                            <?php } else { ?>
                                <<?php echo $htmltag; ?> class="page-title"><?php echo esc_html( valkiriapps_get_option( 'page_title_product' ) ); ?></<?php echo $htmltag; ?>>
                            <?php } ?>    
                            <?php do_action( 'valkiriapps_woocommerce_breadcrumb' ); ?>
                        <?php } else { ?>
                            <<?php echo $htmltag; ?> class="page-title"><?php echo implode('', $output); ?></<?php echo $htmltag; ?>>
                        <?php 
                            if (function_exists('valkiriapps_breadcrumbs') && valkiriapps_get_option('breadcrumbs')):
                                echo valkiriapps_breadcrumbs();
                            endif;
                        } ?>
                    </div>
                </div>
            </div>
        <?php
        }
    }
}