<div class="os-tabs-w menu-shad">
    <div class="os-tabs-controls">
        <ul class="navs navs-tabs upper">
            <li class="navs-item">
                <a class="navs-links <?= $this->uri->segment(2) == 'payments' ? 'active' : '' ?>" href="<?php echo base_url(); ?>admin/payments/"><i class="os-icon picons-thin-icon-thin-0482_gauge_dashboard_empty"></i><span><?php echo get_phrase('home'); ?></span></a>
            </li>
            <li class="navs-item">
                <a class="navs-links <?= $this->uri->segment(2) == 'students_payments' ? 'active' : '' ?>" href="<?php echo base_url(); ?>admin/students_payments/"><i class="os-icon picons-thin-icon-thin-0426_money_payment_dollars_coins_cash"></i><span><?php echo get_phrase('payments'); ?></span></a>
            </li>
            <li class="navs-item">
                <a class="navs-links <?= $this->uri->segment(2) == 'expense' ? 'active' : '' ?>" href="<?php echo base_url(); ?>admin/expense/"><i class="os-icon picons-thin-icon-thin-0420_money_cash_coins_payment_dollars"></i><span><?php echo get_phrase('expense'); ?></span></a>
            </li>
            <li class="navs-item">
                <a class="navs-links <?= $this->uri->segment(2) == 'kas' ? 'active' : '' ?>" href="<?php echo base_url(); ?>admin/kas/"><i class="os-icon picons-thin-icon-thin-0409_wallet_credit_card_money_payment"></i><span><?php echo 'Kas' ?></span></a>
            </li>
            <li class="navs-item">
                <a class="navs-links <?= $this->uri->segment(2) == 'donasi' ? 'active' : '' ?>" href="<?php echo base_url(); ?>admin/donasi/"><i class="picons-thin-icon-thin-0430_money_payment_dollar_coins_cash"></i><span><?php echo 'Donasi' ?></span></a>
            </li>
        </ul>
    </div>
</div><br>