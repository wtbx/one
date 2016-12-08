<span class="icon-info-sign dshbrd-ico"></span>
<?php if ($industry == '1') { ?>
    <div class="row">
        <div class="col-md-4 active">

            <div class="info-box  bg-info  text-white" id="initial-tour">
                <div class="info-icon bg-info-dark">
                    <span aria-hidden="true" class="icon icon-layers"></span>
                </div>
                <div class="info-details">
                    <?php
                    echo $this->Html->link('<h4>Builders<span class="pull-right">' . $builder_all_count . '</span></h4>', '/my-builders', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'My Builders', 'escape' => false));
                    echo $this->Html->link('<p>Approved <span class="badge pull-right bg-white text-success">' . $builder_approve . '</span> </p>', '/my-builders/builder_approved:1', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'My Builders', 'escape' => false));
                    echo $this->Html->link('<p>Pending <span class="badge pull-right bg-white text-success">' . $builder_pending . '</span> </p>', '/my-builders/builder_approved:2', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'My Builders', 'escape' => false));
                    ?>
                </div>
            </div>

        </div>
        <div class="col-md-4 active">
            <div class="info-box  bg-info  text-white" id="initial-tour">
                <div class="info-icon bg-info-dark">
                    <span aria-hidden="true" class="icon icon-layers"></span>
                </div>
                <div class="info-details">
                    <?php
                    echo $this->Html->link('<h4>Projects<span class="pull-right">' . $project_all_count . '</span></h4>', '/my-projects', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'My Projects', 'escape' => false));
                    echo $this->Html->link('<p>Approved <span class="badge pull-right bg-white text-success">' . $project_approve . '</span> </p>', '/my-projects/proj_approved:1', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Approved', 'escape' => false));
                    echo $this->Html->link('<p>Pending <span class="badge pull-right bg-white text-success">' . $project_pending . '</span> </p>', '/my-projects/proj_approved:2', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Pending', 'escape' => false));
                    ?>
                </div>
            </div>


        </div>
        <div class="col-md-4 active">

            <div class="info-box  bg-info  text-white" id="initial-tour">
                <div class="info-icon bg-info-dark">
                    <span aria-hidden="true" class="icon icon-layers"></span>
                </div>
                <div class="info-details">
                    <?php
                    if ($this->Session->read('role_id') <> '6') {
                        echo $this->Html->link('<h4>Clients<span class="pull-right">' . $lead_all_count . '</span></h4>', '/my-clients', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'My Clients', 'escape' => false));
                        ?>
                        <p>Old<span class="badge pull-right bg-white text-success"><?php echo $lead_old_client_count ?> </span> </p>  
                        <p>New<span class="badge pull-right bg-white text-success"><?php echo $lead_new_client_count ?> </span> </p>  
                    <?php } else { ?>
                        <h4>Clients<span class="pull-right">0</span></h4>
                    <?php } ?>
                </div>
            </div>

        </div>	
    </div>

    <div class="row">
        <div class="col-md-4 active">

            <div class="info-box  bg-info  text-white" id="initial-tour">
                <div class="info-icon bg-info-dark">
                    <span aria-hidden="true" class="icon icon-layers"></span>
                </div>
                <div class="info-details">
                    <?php echo $this->Html->link('<h4>Networks<span class="pull-right">0</span></h4>', '/my-builder-contacts', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'My Network', 'escape' => false));
                    ?>
                </div>
            </div>

        </div>

        <div class="col-md-4 active">

            <div class="info-box  bg-info  text-white" id="initial-tour">
                <div class="info-icon bg-info-dark">
                    <span aria-hidden="true" class="icon icon-layers"></span>
                </div>
                <div class="info-details">
                    <?php
                    //$event_all_coun;
                    echo $this->Html->link('<h4>Network Partners<span class="pull-right">0</span></h4>', '/my-partners', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'My Partners', 'escape' => false));
                    ?>
                </div>
            </div>

        </div>
        <div class="col-md-4 active">

            <div class="info-box  bg-info  text-white" id="initial-tour">
                <div class="info-icon bg-info-dark">
                    <span aria-hidden="true" class="icon icon-layers"></span>
                </div>
                <div class="info-details">
                    <?php
                    echo $this->Html->link('<h4>Action Items<span class="pull-right">' . $all_action . '</span></h4>', '/action-items', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'My Builders', 'escape' => false));

                    echo $this->Html->link('<p>Pending <span class="badge pull-right bg-white text-success">' . $all_action_pending . '</span> </p>', '/action-items', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'My Builders', 'escape' => false));
                    ?>
                </div>
            </div>

        </div>
    </div>
    <?php
} elseif ($industry == '2') { // travel
    ?>

    <?php if ($this->Session->read('role_id') == '45') { // Technology Associate
        ?>
        <div class="row">
            <div class="col-md-4 active">

                <div class="info-box  bg-info  text-white" id="initial-tour">
                    <div class="info-icon bg-info-dark">
                        <span aria-hidden="true" class="icon icon-layers"></span>
                    </div>
                    <div class="info-details">
        <?php
        echo $this->Html->link('<h4>Download Section<span class="pull-right"></span></h4>', '/download_tables/download_ota', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Download Section', 'escape' => false));
        ?>
                    </div>
                </div>

            </div>
        </div>
    <?php
    } elseif ($this->Session->read('role_id') == '67') {
                ?>
        <div class="row">
            <div class="col-md-4 active">
                <div class="info-box  bg-info  text-white" id="initial-tour">
                    <div class="info-icon bg-info-dark">
                        <span aria-hidden="true" class="icon icon-layers"></span>
                    </div>
                    <div class="info-details">
        <?php
        echo $this->Html->link('<h4>My Reports<span class="pull-right"></span></h4>', '/to-come/', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Reports', 'escape' => false));
        ?>
                    </div>
                </div>
            </div>            
            <div class="col-md-4 active">

                <div class="info-box  bg-info  text-white" id="initial-tour">
                    <div class="info-icon bg-info-dark">
                        <span aria-hidden="true" class="icon icon-layers"></span>
                    </div>
                    <div class="info-details">
        <?php
        echo $this->Html->link('<h4>My Hotel Images<span class="pull-right"></span></h4>', '/travel_hotel_images/', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Hotel Images', 'escape' => false));
        ?>
                    </div>
                </div>

            </div>
        </div>
    <?php
    } elseif ($this->Session->read('role_id') == '66') {
                ?>
        <div class="row">
            <div class="col-md-4 active">
                <div class="info-box  bg-info  text-white" id="initial-tour">
                    <div class="info-icon bg-info-dark">
                        <span aria-hidden="true" class="icon icon-layers"></span>
                    </div>
                    <div class="info-details">
        <?php
        echo $this->Html->link('<h4>Management Reports<span class="pull-right"></span></h4>', '/to-come/', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Reports', 'escape' => false));
        ?>
                    </div>
                </div>
            </div>
            <div class="col-md-4 active">

                <div class="info-box  bg-info  text-white" id="initial-tour">
                    <div class="info-icon bg-info-dark">
                        <span aria-hidden="true" class="icon icon-layers"></span>
                    </div>
                    <div class="info-details">
        <?php
        echo $this->Html->link('<h4>Administration<span class="pull-right"></span></h4>', '/administration/', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Administration', 'escape' => false));
        ?>
                    </div>
                </div>
            </div>
            <div class="col-md-4 active">

                <div class="info-box  bg-info  text-white" id="initial-tour">
                    <div class="info-icon bg-info-dark">
                        <span aria-hidden="true" class="icon icon-layers"></span>
                    </div>
                    <div class="info-details">
        <?php
        echo $this->Html->link('<h4>Download Section<span class="pull-right"></span></h4>', '/download_tables/download_ota', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Download Section', 'escape' => false));
        ?>
                    </div>
                </div>

            </div>
        </div>
        <div class="row">
            <div class="col-md-4 active">

                <div class="info-box  bg-info  text-white" id="initial-tour">
                    <div class="info-icon bg-info-dark">
                        <span aria-hidden="true" class="icon icon-layers"></span>
                    </div>
                    <div class="info-details">
        <?php
        echo $this->Html->link('<h4>Hotel Images<span class="pull-right"></span></h4>', '/travel_hotel_images/', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Hotel Images', 'escape' => false));
        ?>
                    </div>
                </div>

            </div>
        </div>
    <?php    
    } elseif ($this->Session->read('role_id') == '64') {
        ?>
        <div class="row">
            <div class="col-md-4 active">
                <div class="info-box  bg-info  text-white" id="initial-tour">
                    <div class="info-icon bg-info-dark">
                        <span aria-hidden="true" class="icon icon-layers"></span>
                    </div>
                    <div class="info-details">
        <?php
        echo $this->Html->link('<h4>Reports<span class="pull-right"></span></h4>', '/admin/reports', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Reports', 'escape' => false));
        ?>
                    </div>
                </div>
            </div>
            <div class="col-md-4 active">

                <div class="info-box  bg-info  text-white" id="initial-tour">
                    <div class="info-icon bg-info-dark">
                        <span aria-hidden="true" class="icon icon-layers"></span>
                    </div>
                    <div class="info-details">
        <?php
        echo $this->Html->link('<h4>Administration<span class="pull-right"></span></h4>', '/admin/administration', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Administration', 'escape' => false));
        ?>
                    </div>
                </div>
            </div>
            <div class="col-md-4 active">

                <div class="info-box  bg-info  text-white" id="initial-tour">
                    <div class="info-icon bg-info-dark">
                        <span aria-hidden="true" class="icon icon-layers"></span>
                    </div>
                    <div class="info-details">
        <?php
        echo $this->Html->link('<h4>Data<span class="pull-right"></span></h4>', '/admin/data', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Data', 'escape' => false));
        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
                <div class="col-md-4 active">

                <div class="info-box  bg-info  text-white" id="initial-tour">
                    <div class="info-icon bg-info-dark">
                        <span aria-hidden="true" class="icon icon-layers"></span>
                    </div>
                    <div class="info-details">
        <?php
        echo $this->Html->link('<h4>Mapping Area<span class="pull-right"></span></h4>', '/mappinge_areas/supplier_hotels', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Packages', 'escape' => false));
        ?>
                    </div>
                </div>

            </div>
            <div class="col-md-4 active">

                <div class="info-box  bg-info  text-white" id="initial-tour">
                    <div class="info-icon bg-info-dark">
                        <span aria-hidden="true" class="icon icon-layers"></span>
                    </div>
                    <div class="info-details">
        <?php
        echo $this->Html->link('<h4>WTB Errors<span class="pull-right"></span></h4>', '/travel_wtb_errors/', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'WTB Errors', 'escape' => false));
        ?>
                    </div>
                </div>

            </div>
            <div class="col-md-4 active">

                <div class="info-box  bg-info  text-white" id="initial-tour">
                    <div class="info-icon bg-info-dark">
                        <span aria-hidden="true" class="icon icon-layers"></span>
                    </div>
                    <div class="info-details">
        <?php
        echo $this->Html->link('<h4>Hotel Images<span class="pull-right"></span></h4>', '/travel_hotel_images/', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Hotel Images', 'escape' => false));
        ?>
                    </div>
                </div>

            </div>
        </div>
<div class="row">
<div class="col-md-4 active">
                <div class="info-box  bg-info  text-white" id="initial-tour">
                    <div class="info-icon bg-info-dark">
                        <span aria-hidden="true" class="icon icon-layers"></span>
                    </div>
                    <div class="info-details">
        <?php
        echo $this->Html->link('<h4>Reports<span class="pull-right"></span></h4>', '/admin/reports', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Reports', 'escape' => false));
        ?>
                    </div>
                </div>
            </div>
</div>

        <?php
    } elseif ($this->Session->read('role_id') == '65') {
        ?>
        <div class="row">
            <div class="col-md-4 active">

                <div class="info-box  bg-info  text-white" id="initial-tour">
                    <div class="info-icon bg-info-dark">
                        <span aria-hidden="true" class="icon icon-layers"></span>
                    </div>
                    <div class="info-details">
        <?php
        echo $this->Html->link('<h4>My Hotels<span class="pull-right">' . $hotel_all_count . '</span></h4>', '/my-hotels', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'My Network', 'escape' => false));
        echo $this->Html->link('<p>Approved <span class="badge pull-right bg-white text-success">' . $hotel_approve . '</span> </p>', '/my-hotels/active:1', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Approved', 'escape' => false));
        echo $this->Html->link('<p>Pending <span class="badge pull-right bg-white text-success">' . $hotel_pending . '</span> </p>', '/my-hotels/active:0', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Pending', 'escape' => false));
        ?>
                    </div>
                </div>
            </div>
            <div class="col-md-4 active">

                <div class="info-box  bg-info  text-white" id="initial-tour">
                    <div class="info-icon bg-info-dark">
                        <span aria-hidden="true" class="icon icon-layers"></span>
                    </div>
                    <div class="info-details">
        <?php
        echo $this->Html->link('<h4>My Mapping Area<span class="pull-right"></span></h4>', '/mappinge_areas/supplier_hotels', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'My Mapping Area', 'escape' => false));
        ?>
                    </div>
                </div>

            </div>
            <div class="col-md-4 active">
                <div class="info-box  bg-info  text-white" id="initial-tour">
                    <div class="info-icon bg-info-dark">
                        <span aria-hidden="true" class="icon icon-layers"></span>
                    </div>
                    <div class="info-details">
        <?php
        echo $this->Html->link('<h4>My Reports<span class="pull-right"></span></h4>', '/admin/reports', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'My Reports', 'escape' => false));
        ?>
                    </div>
                </div>
            </div>
        </div>

                        <?php
                    } else {
                        ?>

        <div class="row">
            <div class="col-md-4 active">

                <div class="info-box  bg-info  text-white" id="initial-tour">
                    <div class="info-icon bg-info-dark">
                        <span aria-hidden="true" class="icon icon-layers"></span>
                    </div>
                    <div class="info-details">
        <?php
        echo $this->Html->link('<h4>Agents<span class="pull-right">' . $agent_all_count . '</span></h4>', '/my-agents', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'My Agents', 'escape' => false));
        echo $this->Html->link('<p>Registered <span class="badge pull-right bg-white text-success">' . $agent_registered . '</span> </p>', '/my-builders/builder_approved:1', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'My Builders', 'escape' => false));
        echo $this->Html->link('<p>Allocated <span class="badge pull-right bg-white text-success">' . $agent_allocated . '</span> </p>', '/my-builders/builder_approved:2', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'My Builders', 'escape' => false));
        ?>
                    </div>
                </div>

            </div>
            <div class="col-md-4 active">
                <div class="info-box  bg-info  text-white" id="initial-tour">
                    <div class="info-icon bg-info-dark">
                        <span aria-hidden="true" class="icon icon-layers"></span>
                    </div>
                    <div class="info-details">
        <?php
        echo $this->Html->link('<h4>Corporates<span class="pull-right">0</span></h4>', '/my-projects', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'My Projects', 'escape' => false));
        echo $this->Html->link('<p>Registered <span class="badge pull-right bg-white text-success">0</span> </p>', '/my-projects/proj_approved:1', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Approved', 'escape' => false));
        echo $this->Html->link('<p>Allocated <span class="badge pull-right bg-white text-success">0</span> </p>', '/my-projects/proj_approved:2', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Pending', 'escape' => false));
        ?>
                    </div>
                </div>


            </div>
            <div class="col-md-4 active">

                <div class="info-box  bg-info  text-white" id="initial-tour">
                    <div class="info-icon bg-info-dark">
                        <span aria-hidden="true" class="icon icon-layers"></span>
                    </div>
                    <div class="info-details">
        <?php
        echo $this->Html->link('<h4>Retail Clients<span class="pull-right">0</span></h4>', '/my-clients', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'My Clients', 'escape' => false));
        echo $this->Html->link('<p>Registered <span class="badge pull-right bg-white text-success">0</span> </p>', '/my-projects/proj_approved:1', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Registered', 'escape' => false));
        echo $this->Html->link('<p>Allocated <span class="badge pull-right bg-white text-success">0</span> </p>', '/my-projects/proj_approved:2', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Allocated', 'escape' => false));
        ?>


                    </div>
                </div>

            </div>	
        </div>

        <div class="row">
            <div class="col-md-4 active">

                <div class="info-box  bg-info  text-white" id="initial-tour">
                    <div class="info-icon bg-info-dark">
                        <span aria-hidden="true" class="icon icon-layers"></span>
                    </div>
                    <div class="info-details">
        <?php
        echo $this->Html->link('<h4>Distributors<span class="pull-right">0</span></h4>', '/my-builder-contacts', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'My Network', 'escape' => false));

        echo $this->Html->link('<p>Registered <span class="badge pull-right bg-white text-success">0</span> </p>', '/my-projects/proj_approved:1', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Registered', 'escape' => false));
        echo $this->Html->link('<p>Allocated <span class="badge pull-right bg-white text-success">0</span> </p>', '/my-projects/proj_approved:2', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Allocated', 'escape' => false));
        ?>
                    </div>
                </div>

            </div>


            <div class="col-md-4 active">

                <div class="info-box  bg-info  text-white" id="initial-tour">
                    <div class="info-icon bg-info-dark">
                        <span aria-hidden="true" class="icon icon-layers"></span>
                    </div>
                    <div class="info-details">
        <?php
        echo $this->Html->link('<h4>Suppliers<span class="pull-right">' . $supplier_all_count . '</span></h4>', '/my-builder-contacts', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'My Network', 'escape' => false));

        echo $this->Html->link('<p>Approved <span class="badge pull-right bg-white text-success">' . $supplier_approved . '</span> </p>', '/my-projects/proj_approved:1', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Approved', 'escape' => false));
        echo $this->Html->link('<p>Pending <span class="badge pull-right bg-white text-success">' . $supplier_pending . '</span> </p>', '/my-projects/proj_approved:2', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Pending', 'escape' => false));
        ?>
                    </div>
                </div>

            </div>

            <div class="col-md-4 active">

                <div class="info-box  bg-info  text-white" id="initial-tour">
                    <div class="info-icon bg-info-dark">
                        <span aria-hidden="true" class="icon icon-layers"></span>
                    </div>
                    <div class="info-details">
        <?php
        echo $this->Html->link('<h4>Hotels<span class="pull-right">' . $hotel_all_count . '</span></h4>', '/my-hotels', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'My Network', 'escape' => false));

        echo $this->Html->link('<p>Approved <span class="badge pull-right bg-white text-success">' . $hotel_approve . '</span> </p>', '/my-hotels/active:1', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Approved', 'escape' => false));
        echo $this->Html->link('<p>Pending <span class="badge pull-right bg-white text-success">' . $hotel_pending . '</span> </p>', '/my-hotels/active:0', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Pending', 'escape' => false));
        ?>
                    </div>
                </div>

            </div>


        </div>
        <div class="row">
            <div class="col-md-4 active">
                <div class="info-box  bg-info  text-white" id="initial-tour">
                    <div class="info-icon bg-info-dark">
                        <span aria-hidden="true" class="icon icon-layers"></span>
                    </div>
                    <div class="info-details">
        <?php
        //$event_all_coun;
        echo $this->Html->link('<h4>Networks</h4>', '/my-partners', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'My Partners', 'escape' => false));
        echo $this->Html->link('<p>Agent <span class="badge pull-right bg-white text-success">0</span> </p>', '/my-projects/proj_approved:1', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Agent', 'escape' => false));
        echo $this->Html->link('<p>Corporate <span class="badge pull-right bg-white text-success">0</span> </p>', '/my-projects/proj_approved:1', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Corporate', 'escape' => false));
        ?>
                    </div>
                </div>

            </div>
            <div class="col-md-4 active">

                <div class="info-box  bg-info  text-white" id="initial-tour">
                    <div class="info-icon bg-info-dark">
                        <span aria-hidden="true" class="icon icon-layers"></span>
                    </div>
                    <div class="info-details">
        <?php
        echo $this->Html->link('<h4>Mappings<span class="pull-right">' . $mapping_all_count . '</span></h4>', '/mappinges', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'My Builders', 'escape' => false));
        echo $this->Html->link('<p>Supplier Country / City <span class="badge pull-right bg-white text-success">' . $city_county_supplier_count . '</span> </p>', '#', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Supplier Country', 'escape' => false));

        echo $this->Html->link('<p>Supplier Hotel <span class="badge pull-right bg-white text-success">' . $hotel_supplier_all_count . '</span> </p>', '/my-mappings/mapping_type:3', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Supplier Hotel', 'escape' => false));
        ?>
                    </div>
                </div>

            </div>
            <div class="col-md-4 active">

                <div class="info-box  bg-info  text-white" id="initial-tour">
                    <div class="info-icon bg-info-dark">
                        <span aria-hidden="true" class="icon icon-layers"></span>
                    </div>
                    <div class="info-details">
        <?php
        echo $this->Html->link('<h4>Duplicate Mapping<span class="pull-right">' . $duplicate_cnt . '</span></h4>', '/duplicate_mappinges', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'My Builders', 'escape' => false));

        echo $this->Html->link('<p>City <span class="badge pull-right bg-white text-success">' . $duplicate_city_cnt . '</span> </p>', '/duplicate_mappinges', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Pending', 'escape' => false));
        echo $this->Html->link('<p>Hotel <span class="badge pull-right bg-white text-success">' . $duplicate_hotel_cnt . '</span> </p>', '/duplicate_mappinges', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Pending', 'escape' => false));
        ?>
                    </div>
                </div>

            </div>
            <div class="col-md-4 active">

                <div class="info-box  bg-info  text-white" id="initial-tour">
                    <div class="info-icon bg-info-dark">
                        <span aria-hidden="true" class="icon icon-layers"></span>
                    </div>
                    <div class="info-details">
        <?php
        echo $this->Html->link('<h4>Packages<span class="pull-right"></span></h4>', '/package_standard_masters', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Packages', 'escape' => false));
        ?>
                    </div>
                </div>

            </div>
            <div class="col-md-4 active">

                <div class="info-box  bg-info  text-white" id="initial-tour">
                    <div class="info-icon bg-info-dark">
                        <span aria-hidden="true" class="icon icon-layers"></span>
                    </div>
                    <div class="info-details">
        <?php
        echo $this->Html->link('<h4>SightSeeings<span class="pull-right"></span></h4>', '/sight_seeing_elements', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'SightSeeings', 'escape' => false));
        ?>
                    </div>
                </div>

            </div>
            <div class="col-md-4 active">

                <div class="info-box  bg-info  text-white" id="initial-tour">
                    <div class="info-icon bg-info-dark">
                        <span aria-hidden="true" class="icon icon-layers"></span>
                    </div>
                    <div class="info-details">
        <?php
        echo $this->Html->link('<h4>Transfers<span class="pull-right"></span></h4>', '/transfer_elements', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Transfers', 'escape' => false));
        ?>
                    </div>
                </div>
            </div>

        </div>
        <div class="row">
            
            <div class="col-md-4 active">

                <div class="info-box  bg-info  text-white" id="initial-tour">
                    <div class="info-icon bg-info-dark">
                        <span aria-hidden="true" class="icon icon-layers"></span>
                    </div>
                    <div class="info-details">
        <?php
        echo $this->Html->link('<h4>Mapping Area<span class="pull-right"></span></h4>', '/mappinge_areas/supplier_hotels', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Packages', 'escape' => false));
        ?>
                    </div>
                </div>

            </div>
            <div class="col-md-4 active">

                <div class="info-box  bg-info  text-white" id="initial-tour">
                    <div class="info-icon bg-info-dark">
                        <span aria-hidden="true" class="icon icon-layers"></span>
                    </div>
                    <div class="info-details">
        <?php
        echo $this->Html->link('<h4>Reports<span class="pull-right"></span></h4>', '/admin/reports', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Reports', 'escape' => false));
        ?>
                    </div>
                </div>

            </div>
             <div class="col-md-4 active">

                <div class="info-box  bg-info  text-white" id="initial-tour">
                    <div class="info-icon bg-info-dark">
                        <span aria-hidden="true" class="icon icon-layers"></span>
                    </div>
                    <div class="info-details">
        <?php
        echo $this->Html->link('<h4>Hotel Images<span class="pull-right"></span></h4>', '/travel_hotel_images/', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Hotel Images', 'escape' => false));
        ?>
                    </div>
                </div>

            </div>
            
        </div>

                        <?php
                    }
                } elseif ($industry == '5') {
                    if ($this->Session->read('role_id') == '60') {
                        ?>
        <div class="row">
            <div class="col-md-4 active">

                <div class="info-box  bg-info  text-white" id="initial-tour">
                    <div class="info-icon bg-info-dark">
                        <span aria-hidden="true" class="icon icon-layers"></span>
                    </div>
                    <div class="info-details">
        <?php
        echo $this->Html->link('<h4>My Persons<span class="pull-right"></span></h4>', '/my-persons', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'My Persons', 'escape' => false));
        echo $this->Html->link('<p>Validated <span class="badge pull-right bg-white text-success">' . $person_validate_cnt . '</span> </p>', '#', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Validated', 'escape' => false));
        echo $this->Html->link('<p>Currently Using <span class="badge pull-right bg-white text-success">' . $person_currently_cnt . '</span> </p>', '#', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Currently Using', 'escape' => false));
        ?>
                    </div>
                </div>
            </div>
            <div class="col-md-4 active">

                <div class="info-box  bg-info  text-white" id="initial-tour">
                    <div class="info-icon bg-info-dark">
                        <span aria-hidden="true" class="icon icon-layers"></span>
                    </div>
                    <div class="info-details">
        <?php
        echo $this->Html->link('<h4>My Twitters<span class="pull-right"></span></h4>', '/dig_accounts', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'My Twitters', 'escape' => false));
        echo $this->Html->link('<p>Validated<span class="badge pull-right bg-white text-success">' . $validate_cnt . '</span> </p>', '#', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Validated', 'escape' => false));
        echo $this->Html->link('<p>Currently Using<span class="badge pull-right bg-white text-success">' . $currently_cnt . '</span> </p>', '#', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Currently Using', 'escape' => false));
        ?>
                    </div>
                </div>
            </div>

            <div class="col-md-4 active">

                <div class="info-box  bg-info  text-white" id="initial-tour">
                    <div class="info-icon bg-info-dark">
                        <span aria-hidden="true" class="icon icon-layers"></span>
                    </div>
                    <div class="info-details">
        <?php
        echo $this->Html->link('<h4>My Pinterests<span class="pull-right"></span></h4>', '/dig_accounts/index/3', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'My Pinterests', 'escape' => false));
        echo $this->Html->link('<p>Validated<span class="badge pull-right bg-white text-success">' . $pinterest_validate_cnt . '</span> </p>', '#', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Validated', 'escape' => false));
        echo $this->Html->link('<p>Currently Using<span class="badge pull-right bg-white text-success">' . $pinterest_currently_cnt . '</span> </p>', '#', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Currently Using', 'escape' => false));
        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 active">

                <div class="info-box  bg-info  text-white" id="initial-tour">
                    <div class="info-icon bg-info-dark">
                        <span aria-hidden="true" class="icon icon-layers"></span>
                    </div>
                    <div class="info-details">
        <?php
        echo $this->Html->link('<h4>My Facebook<span class="pull-right"></span></h4>', '/dig_accounts/index/41', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'My Facebook', 'escape' => false));
        echo $this->Html->link('<p>Validated<span class="badge pull-right bg-white text-success">' . $facebook_validate_cnt . '</span> </p>', '#', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Validated', 'escape' => false));
        echo $this->Html->link('<p>Currently Using<span class="badge pull-right bg-white text-success">' . $facebook_currently_cnt . '</span> </p>', '#', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Currently Using', 'escape' => false));
        ?>
                    </div>
                </div>
            </div>
            <div class="col-md-4 active">

                <div class="info-box  bg-info  text-white" id="initial-tour">
                    <div class="info-icon bg-info-dark">
                        <span aria-hidden="true" class="icon icon-layers"></span>
                    </div>
                    <div class="info-details">
        <?php
        echo $this->Html->link('<h4>My LinkedIn<span class="pull-right"></span></h4>', '/dig_accounts/index/46', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'My LinkedIn', 'escape' => false));
        echo $this->Html->link('<p>Validated<span class="badge pull-right bg-white text-success">' . $linkedIn_validate_cnt . '</span> </p>', '#', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Validated', 'escape' => false));
        echo $this->Html->link('<p>Currently Using<span class="badge pull-right bg-white text-success">' . $linkedIn_currently_cnt . '</span> </p>', '#', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Currently Using', 'escape' => false));
        ?>
                    </div>
                </div>
            </div>
            <div class="col-md-4 active">

                <div class="info-box  bg-info  text-white" id="initial-tour">
                    <div class="info-icon bg-info-dark">
                        <span aria-hidden="true" class="icon icon-layers"></span>
                    </div>
                    <div class="info-details">
        <?php
        echo $this->Html->link('<h4>My Muzy<span class="pull-right"></span></h4>', '/dig_accounts/index/42', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'My Muzy', 'escape' => false));
        echo $this->Html->link('<p>Validated<span class="badge pull-right bg-white text-success">' . $muzy_validate_cnt . '</span> </p>', '#', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Validated', 'escape' => false));
        echo $this->Html->link('<p>Currently Using<span class="badge pull-right bg-white text-success">' . $muzy_currently_cnt . '</span> </p>', '#', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Currently Using', 'escape' => false));
        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 active">

                <div class="info-box  bg-info  text-white" id="initial-tour">
                    <div class="info-icon bg-info-dark">
                        <span aria-hidden="true" class="icon icon-layers"></span>
                    </div>
                    <div class="info-details">
        <?php
        echo $this->Html->link('<h4>My Newsvine<span class="pull-right"></span></h4>', '/dig_accounts/index/43', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'My Newsvine', 'escape' => false));
        echo $this->Html->link('<p>Validated<span class="badge pull-right bg-white text-success">' . $newsvine_validate_cnt . '</span> </p>', '#', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Validated', 'escape' => false));
        echo $this->Html->link('<p>Currently Using<span class="badge pull-right bg-white text-success">' . $newsvine_currently_cnt . '</span> </p>', '#', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Currently Using', 'escape' => false));
        ?>
                    </div>
                </div>
            </div>
            <div class="col-md-4 active">

                <div class="info-box  bg-info  text-white" id="initial-tour">
                    <div class="info-icon bg-info-dark">
                        <span aria-hidden="true" class="icon icon-layers"></span>
                    </div>
                    <div class="info-details">
        <?php
        echo $this->Html->link('<h4>My Skyrock<span class="pull-right"></span></h4>', '/dig_accounts/index/44', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'My Skyrock', 'escape' => false));
        echo $this->Html->link('<p>Validated<span class="badge pull-right bg-white text-success">' . $skyrock_validate_cnt . '</span> </p>', '#', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Validated', 'escape' => false));
        echo $this->Html->link('<p>Currently Using<span class="badge pull-right bg-white text-success">' . $skyrock_currently_cnt . '</span> </p>', '#', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Currently Using', 'escape' => false));
        ?>
                    </div>
                </div>
            </div>
            <div class="col-md-4 active">

                <div class="info-box  bg-info  text-white" id="initial-tour">
                    <div class="info-icon bg-info-dark">
                        <span aria-hidden="true" class="icon icon-layers"></span>
                    </div>
                    <div class="info-details">
        <?php
        echo $this->Html->link('<h4>My Weheartit<span class="pull-right"></span></h4>', '/dig_accounts/index/45', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'My Weheartit', 'escape' => false));
        echo $this->Html->link('<p>Validated<span class="badge pull-right bg-white text-success">' . $weheartit_validate_cnt . '</span> </p>', '#', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Validated', 'escape' => false));
        echo $this->Html->link('<p>Currently Using<span class="badge pull-right bg-white text-success">' . $weheartit_currently_cnt . '</span> </p>', '#', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Currently Using', 'escape' => false));
        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 active">

                <div class="info-box  bg-info  text-white" id="initial-tour">
                    <div class="info-icon bg-info-dark">
                        <span aria-hidden="true" class="icon icon-layers"></span>
                    </div>
                    <div class="info-details">
        <?php
        echo $this->Html->link('<h4>My Plurk<span class="pull-right"></span></h4>', '/dig_accounts/index/6', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'My Plurk', 'escape' => false));
        echo $this->Html->link('<p>Validated<span class="badge pull-right bg-white text-success">' . $plurk_validate_cnt . '</span> </p>', '#', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Validated', 'escape' => false));
        echo $this->Html->link('<p>Currently Using<span class="badge pull-right bg-white text-success">' . $plurk_currently_cnt . '</span> </p>', '#', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Currently Using', 'escape' => false));
        ?>
                    </div>
                </div>
            </div>
            <div class="col-md-4 active">

                <div class="info-box  bg-info  text-white" id="initial-tour">
                    <div class="info-icon bg-info-dark">
                        <span aria-hidden="true" class="icon icon-layers"></span>
                    </div>
                    <div class="info-details">
        <?php
        echo $this->Html->link('<h4>My Fancy<span class="pull-right"></span></h4>', '/dig_accounts/index/13', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'My Fancy', 'escape' => false));
        echo $this->Html->link('<p>Validated<span class="badge pull-right bg-white text-success">' . $fancy_validate_cnt . '</span> </p>', '#', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Validated', 'escape' => false));
        echo $this->Html->link('<p>Currently Using<span class="badge pull-right bg-white text-success">' . $fancy_currently_cnt . '</span> </p>', '#', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Currently Using', 'escape' => false));
        ?>
                    </div>
                </div>
            </div>
            <div class="col-md-4 active">

                <div class="info-box  bg-info  text-white" id="initial-tour">
                    <div class="info-icon bg-info-dark">
                        <span aria-hidden="true" class="icon icon-layers"></span>
                    </div>
                    <div class="info-details">
        <?php
        echo $this->Html->link('<h4>My Pusha<span class="pull-right"></span></h4>', '/dig_accounts/index/47', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'My Pusha', 'escape' => false));
        echo $this->Html->link('<p>Validated<span class="badge pull-right bg-white text-success">' . $pusha_validate_cnt . '</span> </p>', '#', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Validated', 'escape' => false));
        echo $this->Html->link('<p>Currently Using<span class="badge pull-right bg-white text-success">' . $pusha_currently_cnt . '</span> </p>', '#', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Currently Using', 'escape' => false));
        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 active">

                <div class="info-box  bg-info  text-white" id="initial-tour">
                    <div class="info-icon bg-info-dark">
                        <span aria-hidden="true" class="icon icon-layers"></span>
                    </div>
                    <div class="info-details">
        <?php
        echo $this->Html->link('<h4>My Visualize<span class="pull-right"></span></h4>', '/dig_accounts/index/48', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'My Visualize', 'escape' => false));
        echo $this->Html->link('<p>Validated<span class="badge pull-right bg-white text-success">' . $visualize_validate_cnt . '</span> </p>', '#', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Validated', 'escape' => false));
        echo $this->Html->link('<p>Currently Using<span class="badge pull-right bg-white text-success">' . $visualize_currently_cnt . '</span> </p>', '#', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Currently Using', 'escape' => false));
        ?>
                    </div>
                </div>
            </div>
            <div class="col-md-4 active">

                <div class="info-box  bg-info  text-white" id="initial-tour">
                    <div class="info-icon bg-info-dark">
                        <span aria-hidden="true" class="icon icon-layers"></span>
                    </div>
                    <div class="info-details">
        <?php
        echo $this->Html->link('<h4>My Piccsy<span class="pull-right"></span></h4>', '/dig_accounts/index/49', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'My Piccsy', 'escape' => false));
        echo $this->Html->link('<p>Validated<span class="badge pull-right bg-white text-success">' . $piccsy_validate_cnt . '</span> </p>', '#', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Validated', 'escape' => false));
        echo $this->Html->link('<p>Currently Using<span class="badge pull-right bg-white text-success">' . $piccsy_currently_cnt . '</span> </p>', '#', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Currently Using', 'escape' => false));
        ?>
                    </div>
                </div>
            </div>
            <div class="col-md-4 active">

                <div class="info-box  bg-info  text-white" id="initial-tour">
                    <div class="info-icon bg-info-dark">
                        <span aria-hidden="true" class="icon icon-layers"></span>
                    </div>
                    <div class="info-details">
        <?php
        echo $this->Html->link('<h4>My Scoopit<span class="pull-right"></span></h4>', '/dig_accounts/index/29', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'My Scoopit', 'escape' => false));
        echo $this->Html->link('<p>Validated<span class="badge pull-right bg-white text-success">' . $scoopit_validate_cnt . '</span> </p>', '#', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Validated', 'escape' => false));
        echo $this->Html->link('<p>Currently Using<span class="badge pull-right bg-white text-success">' . $scoopit_currently_cnt . '</span> </p>', '#', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Currently Using', 'escape' => false));
        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 active">

                <div class="info-box  bg-info  text-white" id="initial-tour">
                    <div class="info-icon bg-info-dark">
                        <span aria-hidden="true" class="icon icon-layers"></span>
                    </div>
                    <div class="info-details">
        <?php
        echo $this->Html->link('<h4>My Buzznet<span class="pull-right"></span></h4>', '/dig_accounts/index/50', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'My Buzznet', 'escape' => false));
        echo $this->Html->link('<p>Validated<span class="badge pull-right bg-white text-success">' . $buzznet_validate_cnt . '</span> </p>', '#', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Validated', 'escape' => false));
        echo $this->Html->link('<p>Currently Using<span class="badge pull-right bg-white text-success">' . $buzznet_currently_cnt . '</span> </p>', '#', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Currently Using', 'escape' => false));
        ?>
                    </div>
                </div>
            </div>
            <div class="col-md-4 active">

                <div class="info-box  bg-info  text-white" id="initial-tour">
                    <div class="info-icon bg-info-dark">
                        <span aria-hidden="true" class="icon icon-layers"></span>
                    </div>
                    <div class="info-details">
        <?php
        echo $this->Html->link('<h4>My Tumblr<span class="pull-right"></span></h4>', '/dig_accounts/index/51', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'My Tumblr', 'escape' => false));
        echo $this->Html->link('<p>Validated<span class="badge pull-right bg-white text-success">' . $tumblr_validate_cnt . '</span> </p>', '#', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Validated', 'escape' => false));
        echo $this->Html->link('<p>Currently Using<span class="badge pull-right bg-white text-success">' . $tumblr_currently_cnt . '</span> </p>', '#', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Currently Using', 'escape' => false));
        ?>
                    </div>
                </div>
            </div>
            <div class="col-md-4 active">

                <div class="info-box  bg-info  text-white" id="initial-tour">
                    <div class="info-icon bg-info-dark">
                        <span aria-hidden="true" class="icon icon-layers"></span>
                    </div>
                    <div class="info-details">
        <?php
        echo $this->Html->link('<h4>My Diigo<span class="pull-right"></span></h4>', '/dig_accounts/index/30', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'My Diigo', 'escape' => false));
        echo $this->Html->link('<p>Validated<span class="badge pull-right bg-white text-success">' . $diigo_validate_cnt . '</span> </p>', '#', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Validated', 'escape' => false));
        echo $this->Html->link('<p>Currently Using<span class="badge pull-right bg-white text-success">' . $diigo_currently_cnt . '</span> </p>', '#', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Currently Using', 'escape' => false));
        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 active">

                <div class="info-box  bg-info  text-white" id="initial-tour">
                    <div class="info-icon bg-info-dark">
                        <span aria-hidden="true" class="icon icon-layers"></span>
                    </div>
                    <div class="info-details">
        <?php
        echo $this->Html->link('<h4>My Behance<span class="pull-right"></span></h4>', '/dig_accounts/index/52', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'My Behance', 'escape' => false));
        echo $this->Html->link('<p>Validated<span class="badge pull-right bg-white text-success">' . $behance_validate_cnt . '</span> </p>', '#', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Validated', 'escape' => false));
        echo $this->Html->link('<p>Currently Using<span class="badge pull-right bg-white text-success">' . $behance_currently_cnt . '</span> </p>', '#', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Currently Using', 'escape' => false));
        ?>
                    </div>
                </div>
            </div>
            <div class="col-md-4 active">

                <div class="info-box  bg-info  text-white" id="initial-tour">
                    <div class="info-icon bg-info-dark">
                        <span aria-hidden="true" class="icon icon-layers"></span>
                    </div>
                    <div class="info-details">
        <?php
        echo $this->Html->link('<h4>My Google Plus<span class="pull-right"></span></h4>', '/dig_accounts/index/1', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'My Google Plus', 'escape' => false));
        echo $this->Html->link('<p>Validated<span class="badge pull-right bg-white text-success">' . $googlepl_validate_cnt . '</span> </p>', '#', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Validated', 'escape' => false));
        echo $this->Html->link('<p>Currently Using<span class="badge pull-right bg-white text-success">' . $googlepl_currently_cnt . '</span> </p>', '#', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Currently Using', 'escape' => false));
        ?>
                    </div>
                </div>
            </div>

        </div>
                    <?php } else { ?>
        <div class="row">
            <div class="col-md-4 active">

                <div class="info-box  bg-info  text-white" id="initial-tour">
                    <div class="info-icon bg-info-dark">
                        <span aria-hidden="true" class="icon icon-layers"></span>
                    </div>
                    <div class="info-details">
        <?php
        echo $this->Html->link('<h4>My Bases<span class="pull-right"></span></h4>', '/dig_bases', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'My Task', 'escape' => false));
        //echo $this->Html->link('<p>Registered <span class="badge pull-right bg-white text-success">'.$agent_registered.'</span> </p>', '/my-builders/builder_approved:1', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'My Builders', 'escape' => false));
        // echo $this->Html->link('<p>Allocated <span class="badge pull-right bg-white text-success">'.$agent_allocated.'</span> </p>', '/my-builders/builder_approved:2', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'My Builders', 'escape' => false));
        ?>
                    </div>
                </div>
            </div>
            <div class="col-md-4 active">

                <div class="info-box  bg-info  text-white" id="initial-tour">
                    <div class="info-icon bg-info-dark">
                        <span aria-hidden="true" class="icon icon-layers"></span>
                    </div>
                    <div class="info-details">
        <?php
        echo $this->Html->link('<h4>My Persons<span class="pull-right"></span></h4>', '/my-persons', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'My Task', 'escape' => false));
        //echo $this->Html->link('<p>Registered <span class="badge pull-right bg-white text-success">'.$agent_registered.'</span> </p>', '/my-builders/builder_approved:1', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'My Builders', 'escape' => false));
        // echo $this->Html->link('<p>Allocated <span class="badge pull-right bg-white text-success">'.$agent_allocated.'</span> </p>', '/my-builders/builder_approved:2', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'My Builders', 'escape' => false));
        ?>
                    </div>
                </div>
            </div>
            <div class="col-md-4 active">

                <div class="info-box  bg-info  text-white" id="initial-tour">
                    <div class="info-icon bg-info-dark">
                        <span aria-hidden="true" class="icon icon-layers"></span>
                    </div>
                    <div class="info-details">
        <?php
        echo $this->Html->link('<h4>My Accounts<span class="pull-right"></span></h4>', '/dig_accounts', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'My Task', 'escape' => false));
        //echo $this->Html->link('<p>Registered <span class="badge pull-right bg-white text-success">'.$agent_registered.'</span> </p>', '/my-builders/builder_approved:1', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'My Builders', 'escape' => false));
        // echo $this->Html->link('<p>Allocated <span class="badge pull-right bg-white text-success">'.$agent_allocated.'</span> </p>', '/my-builders/builder_approved:2', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'My Builders', 'escape' => false));
        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 active">

                <div class="info-box  bg-info  text-white" id="initial-tour">
                    <div class="info-icon bg-info-dark">
                        <span aria-hidden="true" class="icon icon-layers"></span>
                    </div>
                    <div class="info-details">
        <?php
        echo $this->Html->link('<h4>My Topics<span class="pull-right"></span></h4>', '/dig_topics', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'My Task', 'escape' => false));
        //echo $this->Html->link('<p>Registered <span class="badge pull-right bg-white text-success">'.$agent_registered.'</span> </p>', '/my-builders/builder_approved:1', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'My Builders', 'escape' => false));
        // echo $this->Html->link('<p>Allocated <span class="badge pull-right bg-white text-success">'.$agent_allocated.'</span> </p>', '/my-builders/builder_approved:2', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'My Builders', 'escape' => false));
        ?>
                    </div>
                </div>
            </div>
            <div class="col-md-4 active">

                <div class="info-box  bg-info  text-white" id="initial-tour">
                    <div class="info-icon bg-info-dark">
                        <span aria-hidden="true" class="icon icon-layers"></span>
                    </div>
                    <div class="info-details">
        <?php
        echo $this->Html->link('<h4>My Tasks<span class="pull-right"></span></h4>', '/dig_media_tasks', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'My Task', 'escape' => false));
        //echo $this->Html->link('<p>Registered <span class="badge pull-right bg-white text-success">'.$agent_registered.'</span> </p>', '/my-builders/builder_approved:1', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'My Builders', 'escape' => false));
        // echo $this->Html->link('<p>Allocated <span class="badge pull-right bg-white text-success">'.$agent_allocated.'</span> </p>', '/my-builders/builder_approved:2', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'My Builders', 'escape' => false));
        ?>
                    </div>
                </div>
            </div>

        </div>
                        <?php
                    }
                }
                elseif ($industry == '6') {
                    ?>
<div class="row">
     
    <div class="col-md-4 active">

                <div class="info-box  bg-info  text-white" id="initial-tour">
                    <div class="info-icon bg-info-dark">
                        <span aria-hidden="true" class="icon icon-layers"></span>
                    </div>
                    <div class="info-details">
        <?php
        echo $this->Html->link('<h4>My Roles<span class="pull-right"></span></h4>', '/my-roles', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'My Roles', 'escape' => false));
        //echo $this->Html->link('<p>Registered <span class="badge pull-right bg-white text-success">'.$agent_registered.'</span> </p>', '/my-builders/builder_approved:1', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'My Builders', 'escape' => false));
        // echo $this->Html->link('<p>Allocated <span class="badge pull-right bg-white text-success">'.$agent_allocated.'</span> </p>', '/my-builders/builder_approved:2', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'My Builders', 'escape' => false));
        ?>
                    </div>
                </div>
            </div>
    <div class="col-md-4 active">

                <div class="info-box  bg-info  text-white" id="initial-tour">
                    <div class="info-icon bg-info-dark">
                        <span aria-hidden="true" class="icon icon-layers"></span>
                    </div>
                    <div class="info-details">
        <?php
        echo $this->Html->link('<h4>My Groups<span class="pull-right"></span></h4>', '/my-groups', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'My Groups', 'escape' => false));
        //echo $this->Html->link('<p>Registered <span class="badge pull-right bg-white text-success">'.$agent_registered.'</span> </p>', '/my-builders/builder_approved:1', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'My Builders', 'escape' => false));
        // echo $this->Html->link('<p>Allocated <span class="badge pull-right bg-white text-success">'.$agent_allocated.'</span> </p>', '/my-builders/builder_approved:2', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'My Builders', 'escape' => false));
        ?>
                    </div>
                </div>
            </div>
    <div class="col-md-4 active">

                <div class="info-box  bg-info  text-white" id="initial-tour">
                    <div class="info-icon bg-info-dark">
                        <span aria-hidden="true" class="icon icon-layers"></span>
                    </div>
                    <div class="info-details">
        <?php
        echo $this->Html->link('<h4>My Channels<span class="pull-right"></span></h4>', '/my-channels', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'My Channels', 'escape' => false));
        //echo $this->Html->link('<p>Registered <span class="badge pull-right bg-white text-success">'.$agent_registered.'</span> </p>', '/my-builders/builder_approved:1', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'My Builders', 'escape' => false));
        // echo $this->Html->link('<p>Allocated <span class="badge pull-right bg-white text-success">'.$agent_allocated.'</span> </p>', '/my-builders/builder_approved:2', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'My Builders', 'escape' => false));
        ?>
                    </div>
                </div>
            </div>
    <div class="col-md-4 active">

                <div class="info-box  bg-info  text-white" id="initial-tour">
                    <div class="info-icon bg-info-dark">
                        <span aria-hidden="true" class="icon icon-layers"></span>
                    </div>
                    <div class="info-details">
        <?php
        echo $this->Html->link('<h4>My Users<span class="pull-right"></span></h4>', '/my-users', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'My Users', 'escape' => false));
        //echo $this->Html->link('<p>Registered <span class="badge pull-right bg-white text-success">'.$agent_registered.'</span> </p>', '/my-builders/builder_approved:1', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'My Builders', 'escape' => false));
        // echo $this->Html->link('<p>Allocated <span class="badge pull-right bg-white text-success">'.$agent_allocated.'</span> </p>', '/my-builders/builder_approved:2', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'My Builders', 'escape' => false));
        ?>
                    </div>
                </div>
            </div>

<div class="col-md-4 active">

                <div class="info-box  bg-info  text-white" id="initial-tour">
                    <div class="info-icon bg-info-dark">
                        <span aria-hidden="true" class="icon icon-layers"></span>
                    </div>
                    <div class="info-details">
        <?php
        echo $this->Html->link('<h4>My Permissions<span class="pull-right"></span></h4>', '/my-permissions', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'My Permissions', 'escape' => false));
        //echo $this->Html->link('<p>Registered <span class="badge pull-right bg-white text-success">'.$agent_registered.'</span> </p>', '/my-builders/builder_approved:1', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'My Builders', 'escape' => false));
        // echo $this->Html->link('<p>Allocated <span class="badge pull-right bg-white text-success">'.$agent_allocated.'</span> </p>', '/my-builders/builder_approved:2', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'My Builders', 'escape' => false));
        ?>
                    </div>
                </div>
            </div>
</div>

<?php
                    
                }

//pr($SupportTickets);
                ?>
<div class="row">
    <div class="col-lg-12">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#home1" data-toggle="tab"><span class="badge badge-circle badge-success"><?php echo $this->Paginator->counter(array('format' => '{:count}')); ?></span> Open Support Tickets</a></li>
            <li><span class="badge badge-circle badge-important"><span aria-hidden="true" class="icon icon-settings"><?php echo $this->Html->link('Open New Ticket', '/support_tickets/add/1', array('class' => 'act-ico open-popup-link add-btn', 'escape' => false, 'data-placement' => "left", 'title' => "Open New Ticket", 'data-toggle' => "tooltip")); ?></span> </span></li>
        </ul>
        <table class="table table-data table-hover">
            <thead>
                <tr>
                    <th>Ticket #</th>
                    <th class="hidden-sm hidden-xs">Raised By</th>
                    <th class="hidden-sm hidden-xs">Raised On</th>
                    <th class="hidden-sm hidden-xs">Raised From</th> 
                    <th class="hidden-sm hidden-xs">Raised About</th> 
                    <th class="hidden-sm hidden-xs">Topic</th>
                    <th>Urgency</th>
                    <th>Last Action By</th>
                    <th>Next Action By</th>
                    <th>Approved By</th>
                    <th>Current Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
<?php
if (isset($SupportTickets) && count($SupportTickets) > 0):
    foreach ($SupportTickets as $SupportTicket):
        $id = $SupportTicket['SupportTicket']['id'];
        $status = $SupportTicket['SupportTicket']['status'];
        ?>
                        <tr>
                            <td><?php echo $id; ?></td>
                            <td><?php echo $this->Custom->Username($SupportTicket['SupportTicket']['created_by']); ?></td>
                            <td><?php echo $SupportTicket['SupportTicket']['created']; ?></td>
                            <td><?php echo $SupportTicket['LookupScreen']['value']; ?></td>
                            <td><?php echo $SupportTicket['SupportTicket']['about']; ?></td>

                            <td><?php echo $SupportTicket['Answer']['question']; ?></td>
                            <td><?php echo $SupportTicket['LookupTicketUrgency']['value']; ?></td>
                           <td><?php echo ($SupportTicket['SupportTicket']['last_action_by']) ? $this->Custom->Username($SupportTicket['SupportTicket']['last_action_by']) : ''; ?></td>                                                            
                            <td><?php echo ($SupportTicket['SupportTicket']['next_action_by']) ? $this->Custom->Username($SupportTicket['SupportTicket']['next_action_by']) : ''; ?></td>
                            <td><?php echo ($SupportTicket['SupportTicket']['approved_by']) ? $this->Custom->Username($SupportTicket['SupportTicket']['approved_by']) : ''; ?></td>
                            <td><?php echo $SupportTicket['LookupTicketStatus']['value']; ?></td>
                            <td width="10%" valign="middle" align="center">
        <?php
        if(($SupportTicket['SupportTicket']['last_action_by'] == $self_id || $SupportTicket['SupportTicket']['approved_by'] == $self_id) && ($SupportTicket['SupportTicket']['status'] == '1' || $SupportTicket['SupportTicket']['status'] == '2' || $SupportTicket['SupportTicket']['status'] == '3')){
                                        echo $this->Html->link('<span class="icon-eye-open"></span>', '/support_tickets/view/'.$id,array('class' => 'add-btn','target' => '_blank','escape' => false));                                   
                                    }                                    
                                    else
                                        echo $this->Html->link('<span class="icon-pencil"></span>', '/support_tickets/view/'.$id,array('class' => 'add-btn','target' => '_blank','escape' => false));                                   
        /*
          echo ($SupportTicket['SupportTicket']['status'] == '1') ?
          $this->Html->link('<span class="icon-pencil"></span>', '/support_tickets/view/'.$id,array('class' => 'add-btn','target' => '_blank','escape' => false,'data-placement' => "left", 'title' => "View Ticket",'data-toggle' => "tooltip")) :
          $this->Html->link('<span class="icon-eye-open"></span>', '/support_tickets/view/'.$id,array('class' => 'add-btn','target' => '_blank','escape' => false,'data-placement' => "left", 'title' => "View Ticket",'data-toggle' => "tooltip"));
         * 
         */
        //echo $this->Html->link('<span class="icon-eye-open"></span>', '/support_tickets/view/'.$id,array('class' => 'add-btn','target' => '_blank','escape' => false,'data-placement' => "left", 'title' => "View Ticket",'data-toggle' => "tooltip"));
        //echo $this->Html->link('<span class="icon-list"></span>', '/support_tickets/response/'.$id, array('class' => 'act-ico open-popup-link add-btn', 'escape' => false, 'data-placement' => "left", 'title' => "Action", 'data-toggle' => "tooltip"));
        ?>

                            </td>


                        </tr>
                            <?php endforeach; ?>

                            <?php
                            echo $this->element('paginate');
                        else:
                            echo '<tr><td colspan="11" class="norecords">No Records Found</td></tr>';
                        endif;
                        ?>
            </tbody>
        </table>


    </div>
</div>







<!--</div>-->