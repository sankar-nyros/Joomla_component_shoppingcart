<?php
/*------------------------------------------------------------------------
# com_j2store - J2 Store v 1.0
# ------------------------------------------------------------------------
# author    Sasi varna kumar - Weblogicx India http://www.weblogicxindia.com
# copyright Copyright (C) 2012 Weblogicxindia.com. All Rights Reserved.
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites: http://j2store.org
# Technical Support:  Forum - http://j2store.org/forum/index.html
-------------------------------------------------------------------------*/



// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
        $link = JRoute::_('index.php?option=com_j2store&view=mycart&Itemid='.$this->params->get('itemid'));
?>
                        <?php if ( $this->items) { ?>
                                <table id="cart">
                                        <tr>
                                                <th width="10%" ><?php echo JText::_('QUANTITY'); ?></th>
                                                <th width="25%"><?php echo JText::_('ITEMNAME'); ?></th>
                                                <th width="10%"><?php echo JText::_('ITEMID'); ?></th>
                                                <th width="15%"><?php echo JText::_('UNIT PRICE'); ?></th>
                                                <th width="15%"><?php echo JText::_('TOTAL'); ?></th>
                                        </tr>
                                        <?php
                                                $total_price = $i = 0;
                                                foreach ( $this->items as $order_code=>$quantity ) :
                                                        //get the item price
                                                        $item_price = $this->model->getItemPrice($order_code);
                                                        
                                                        //get item tax
                                                        $get_item_tax = $this->model->getItemTax($order_code);
                                                        
                                                        //calculate total price 
                                                        $total_price += $quantity*$item_price;
                                                        $total_tax += $quantity*$get_item_tax;
                                                
                                        ?>
                                                <?php echo $i++%2==0 ? "<tr class='cartline even product$order_code'>" : "<tr class='cartline odd product$order_code'>"; ?>
                                                        <td class="quantity center"><?php echo $quantity; ?></td>
                                                        <td class="item_name"><?php echo $this->model->getItemName($order_code); ?></td>
                                                        <td class="order_code"><?php echo $order_code; ?></td>
                                                        <td class="unit_price_td"><span class="just_unit_price"><?php echo J2StorePrices::number($item_price); ?></span></td>
                                                        <td class="extended_price"><span class="just_ext_price"><?php echo J2StorePrices::number($this->model->getItemTotal($order_code, $quantity)); ?></span></td>
                                                </tr>
                                        <?php endforeach; ?>
                                        <tr><td align="right" colspan="4"><?php echo JText::_('TOTAL'); ?> : &nbsp;&nbsp;</td><td id="total_price"><span><?php echo J2StorePrices::number($total_price); ?></span></td></tr>
                                        
                                        <?php if ($this->params->get('show_tax_total')) { ?>
                                        <tr><td align="right" colspan="4"><?php echo JText::_('TOTAL TAX'); ?> : &nbsp;&nbsp;</td><td id="total_tax">
                                        <?php echo J2StoreUtilities::number( $total_tax); ?>                                    
                                        </td></tr>
                                        <?php } ?>
                                        
                                </table>
                        <?php } else { ?>
                                <p class="center"><?php echo JText::_('NO ITEMS'); ?></p>
                        <?php } ?>
