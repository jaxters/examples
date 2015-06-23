<p>Abou TravelGuide</p>

{if $data->user =="admin"}

<div>
			    <table id="datatable1" class="display">
            <thead>
                        <td style="width:200px" align="center"><b>File name</b></td>
                        <td align="center"><b>Description</b></td>
                        <td style="width:100px"><b>Options</b></td>
                </thead>
                
                {foreach $data->allEbooksArray as $row}
                <tr>
                            <input type="text" class="hidden" hidden id="Id{$row['Id']}" value="{$row['Id']}">
                            <!--<td style='text-align: left' id="Id{$row['Id']}">{$row['Id']}</td>-->
                            <td style='text-align: left' id="ebookNazwa{$row['Id']}">{$row['nazwa']}</td>
                            <td style='text-align: left' id="ebookOpis{$row['opis']}">{$row['opis']}</td>
                            <td>    
                                <form method="POST">
                                    <a class="button" style="width:100px" href="/{$row['dane']}" target="myTab">Download</a>
                                    <input type="text" hidden id='storage' value="{$row['Id']}" name="ebookDownloadId"/>
                                </form>
                                <button class="button" style="width:100px" onclick="Delete({$row['Id']},'{$row['dane']}')" id="delete{$row['Id']}">Delete</button>
                            </td>
                </tr>  
                {/foreach}
                <tbody>
                    <tfoot>
                    <td><button class="button" style="width:100px"  id="add">Add</button></td>
                    </tfoot>
                </tbody>
        </table>
</div>

<div id="dialogAdd" title="Dane" style="display: none;">
    <form method="POST" id="ebookSubmitAdd" enctype="multipart/form-data">
        <table>
            <tr>
                <td colspan="2" style="width:200px">Description (max. 250 chars.):</td>
            </tr>
            <tr>
                <td colspan="2"><textarea maxlength="250" name="ebookOpis" value="" id="ebookOpis" type="text" style='width: 500px'></textarea></td>
                
            </tr>
            <tr>
                <td style="width:200px">File (PDF):</td>
               <td>
                    <input type="hidden" name="MAX_FILE_SIZE" value="16777216">
                    <input name="userfile" type="file" id="userfile">
                </td> 
            </tr>
        </table>
        <table>    
            <hr>
            <tr>
                <td height="50" align="right" style="width:500px">
                    <input type="text" hidden id='storage' value="ebookSubmit" name="ebookSubmit" class=''>
                    <input class="button" name="upload" type="submit" class="box" id="upload" value="Upload"></td>
            </tr>
        </table>
    </form>
</div>

<div id="dialog-confirm" style="display:none;"><p style="text-align: center">Delete this item ?</p></div>

<script>
            $(function() {
                        $("#dialogAdd").hide();

            });
</script>

<script>
            $(function() {


            $("#add").click(function() {
                    $(".id").remove();
                    $("#ebookOpis").val('');

                    $("#dialogAdd").dialog({
            resizable: false,
                    width: 650
            });
            });
            });
</script>

<script>
            function Delete(id,linkId){
            $("#dialog-confirm").show();
                    $("#dialog-confirm").dialog({
            resizable: false,
                    height:200,
                    width:380,
                    modal: true,
                    buttons: {
                        "Yes": function() {


                            $.post('',{ ebookDelete: id, link: linkId})
                                .done(function() {
                                    alert( "Deleted" );
                                    window.location.href = "/admin/eBooks";
                                    
                                })
                                .fail(function() {
                                    alert( "Error while deleting." );
                                })



                            $(this).dialog("close");
                        },
                        "No": function() {
                            $(this).dialog("close");
                        }
                    }
                    
            });
            };

</script>

<script>
$(document).ready( function () {
    $('#datatable1').DataTable();
} );
</script>
{/if}

