<?php
$comp_model = new SharedController;
$page_element_id = "view-page-" . random_str();
$current_page = $this->set_current_page_link();
$csrf_token = Csrf::$token;
//Page Data Information from Controller
$data = $this->view_data;
//$rec_id = $data['__tableprimarykey'];
$page_id = $this->route->page_id; //Page id from url
$view_title = $this->view_title;
$show_header = $this->show_header;
$show_edit_btn = $this->show_edit_btn;
$show_delete_btn = $this->show_delete_btn;
$show_export_btn = $this->show_export_btn;
?>
<section class="page" id="<?php echo $page_element_id; ?>" data-page-type="view"  data-display-type="table" data-page-url="<?php print_link($current_page); ?>">
    <?php
    if( $show_header == true ){
    ?>
    <div  class="bg-light p-3 mb-3">
        <div class="container">
            <div class="row ">
                <div class="col ">
                    <h4 class="record-title">View  Books</h4>
                </div>
            </div>
        </div>
    </div>
    <?php
    }
    ?>
    <div  class="">
        <div class="container">
            <div class="row ">
                <div class="col-md-12 comp-grid">
                    <?php $this :: display_page_errors(); ?>
                    <div  class="card animated fadeIn page-content">
                        <?php
                        $counter = 0;
                        if(!empty($data)){
                        $rec_id = (!empty($data['book_id']) ? urlencode($data['book_id']) : null);
                        $counter++;
                        ?>
                        <div id="page-report-body" class="">
                            <table class="table table-hover table-borderless table-striped">
                                <!-- Table Body Start -->
                                <tbody class="page-data" id="page-data-<?php echo $page_element_id; ?>">
                                    <tr  class="td-book_id">
                                        <th class="title"> Book Id: </th>
                                        <td class="value"> <?php echo $data['book_id']; ?></td>
                                    </tr>
                                    <tr  class="td-title">
                                        <th class="title"> Title: </th>
                                        <td class="value">
                                            <span  data-value="<?php echo $data['title']; ?>" 
                                                data-pk="<?php echo $data['book_id'] ?>" 
                                                data-url="<?php print_link("books/editfield/" . urlencode($data['book_id'])); ?>" 
                                                data-name="title" 
                                                data-title="Enter Title" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['title']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-category_id">
                                        <th class="title"> Category Id: </th>
                                        <td class="value">
                                            <span  data-source='<?php print_link('api/json/books_category_id_option_list'); ?>' 
                                                data-value="<?php echo $data['category_id']; ?>" 
                                                data-pk="<?php echo $data['book_id'] ?>" 
                                                data-url="<?php print_link("books/editfield/" . urlencode($data['book_id'])); ?>" 
                                                data-name="category_id" 
                                                data-title="Select a value ..." 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="select" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['category_id']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-author">
                                        <th class="title"> Author: </th>
                                        <td class="value">
                                            <span  data-value="<?php echo $data['author']; ?>" 
                                                data-pk="<?php echo $data['book_id'] ?>" 
                                                data-url="<?php print_link("books/editfield/" . urlencode($data['book_id'])); ?>" 
                                                data-name="author" 
                                                data-title="Enter Author" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['author']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-publisher">
                                        <th class="title"> Publisher: </th>
                                        <td class="value">
                                            <span  data-value="<?php echo $data['publisher']; ?>" 
                                                data-pk="<?php echo $data['book_id'] ?>" 
                                                data-url="<?php print_link("books/editfield/" . urlencode($data['book_id'])); ?>" 
                                                data-name="publisher" 
                                                data-title="Enter Publisher" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['publisher']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-lend_duration">
                                        <th class="title"> Lend Duration: </th>
                                        <td class="value">
                                            <span  data-value="<?php echo $data['lend_duration']; ?>" 
                                                data-pk="<?php echo $data['book_id'] ?>" 
                                                data-url="<?php print_link("books/editfield/" . urlencode($data['book_id'])); ?>" 
                                                data-name="lend_duration" 
                                                data-title="Enter Lend Duration" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="number" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['lend_duration']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-serial_number">
                                        <th class="title"> Serial Number: </th>
                                        <td class="value">
                                            <span  data-value="<?php echo $data['serial_number']; ?>" 
                                                data-pk="<?php echo $data['book_id'] ?>" 
                                                data-url="<?php print_link("books/editfield/" . urlencode($data['book_id'])); ?>" 
                                                data-name="serial_number" 
                                                data-title="Enter Serial Number" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['serial_number']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-version">
                                        <th class="title"> Version: </th>
                                        <td class="value">
                                            <span  data-value="<?php echo $data['version']; ?>" 
                                                data-pk="<?php echo $data['book_id'] ?>" 
                                                data-url="<?php print_link("books/editfield/" . urlencode($data['book_id'])); ?>" 
                                                data-name="version" 
                                                data-title="Enter Version" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['version']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-year_published">
                                        <th class="title"> Year Published: </th>
                                        <td class="value">
                                            <span  data-value="<?php echo $data['year_published']; ?>" 
                                                data-pk="<?php echo $data['book_id'] ?>" 
                                                data-url="<?php print_link("books/editfield/" . urlencode($data['book_id'])); ?>" 
                                                data-name="year_published" 
                                                data-title="Enter Year Published" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="number" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['year_published']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-file">
                                        <th class="title"> File: </th>
                                        <td class="value">
                                            <span  data-value="<?php echo $data['file']; ?>" 
                                                data-pk="<?php echo $data['book_id'] ?>" 
                                                data-url="<?php print_link("books/editfield/" . urlencode($data['book_id'])); ?>" 
                                                data-name="file" 
                                                data-title="Browse..." 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['file']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-thumbnail">
                                        <th class="title"> Thumbnail: </th>
                                        <td class="value">
                                            <span  data-value="<?php echo $data['thumbnail']; ?>" 
                                                data-pk="<?php echo $data['book_id'] ?>" 
                                                data-url="<?php print_link("books/editfield/" . urlencode($data['book_id'])); ?>" 
                                                data-name="thumbnail" 
                                                data-title="Browse..." 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['thumbnail']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                </tbody>
                                <!-- Table Body End -->
                            </table>
                        </div>
                        <div class="p-3 d-flex">
                            <div class="dropup export-btn-holder mx-1">
                                <button class="btn btn-sm btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-save"></i> Export
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <?php $export_print_link = $this->set_current_page_link(array('format' => 'print')); ?>
                                    <a class="dropdown-item export-link-btn" data-format="print" href="<?php print_link($export_print_link); ?>" target="_blank">
                                        <img src="<?php print_link('assets/images/print.png') ?>" class="mr-2" /> PRINT
                                        </a>
                                        <?php $export_pdf_link = $this->set_current_page_link(array('format' => 'pdf')); ?>
                                        <a class="dropdown-item export-link-btn" data-format="pdf" href="<?php print_link($export_pdf_link); ?>" target="_blank">
                                            <img src="<?php print_link('assets/images/pdf.png') ?>" class="mr-2" /> PDF
                                            </a>
                                            <?php $export_word_link = $this->set_current_page_link(array('format' => 'word')); ?>
                                            <a class="dropdown-item export-link-btn" data-format="word" href="<?php print_link($export_word_link); ?>" target="_blank">
                                                <img src="<?php print_link('assets/images/doc.png') ?>" class="mr-2" /> WORD
                                                </a>
                                                <?php $export_csv_link = $this->set_current_page_link(array('format' => 'csv')); ?>
                                                <a class="dropdown-item export-link-btn" data-format="csv" href="<?php print_link($export_csv_link); ?>" target="_blank">
                                                    <img src="<?php print_link('assets/images/csv.png') ?>" class="mr-2" /> CSV
                                                    </a>
                                                    <?php $export_excel_link = $this->set_current_page_link(array('format' => 'excel')); ?>
                                                    <a class="dropdown-item export-link-btn" data-format="excel" href="<?php print_link($export_excel_link); ?>" target="_blank">
                                                        <img src="<?php print_link('assets/images/xsl.png') ?>" class="mr-2" /> EXCEL
                                                        </a>
                                                    </div>
                                                </div>
                                                <a class="btn btn-sm btn-info"  href="<?php print_link("books/edit/$rec_id"); ?>">
                                                    <i class="fa fa-edit"></i> Edit
                                                </a>
                                                <a class="btn btn-sm btn-danger record-delete-btn mx-1"  href="<?php print_link("books/delete/$rec_id/?csrf_token=$csrf_token&redirect=$current_page"); ?>" data-prompt-msg="Are you sure you want to delete this record?" data-display-style="modal">
                                                    <i class="fa fa-times"></i> Delete
                                                </a>
                                            </div>
                                            <?php
                                            }
                                            else{
                                            ?>
                                            <!-- Empty Record Message -->
                                            <div class="text-muted p-3">
                                                <i class="fa fa-ban"></i> No Record Found
                                            </div>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
