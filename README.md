Codeigniter-StoredProcedures
============================

Simple class to let you run stored procedures using the active records class within codeigniter.

I'm working on a project where the DBA team insists on only using stored procedures to access the database.
This is my attempt to be somewhat lazy. I'm pretty sure there is a better way to do this, but his works for me. 

The idea is to use the standard query bindings feature in the active records class (found at http://codeigniter.com/user_guide/database/queries.html).

Place the Sp.php file within the application/libraries directory of your codeigniter install.
You can either autoload the library from within the autoload.php file or just load it within your model as you normally would.

The syntax is pretty straight-forward:

    $sp_name = 'SaveContactImportHeader';
    $para = array(
                    'in_SystemUserID' => $client->system_user_id,
                    'in_FieldNameString' => $db_data1,
                    'in_isTestFlag' => $is_test
                    );
    $out = '@out_ContactImportHeaderId';
    
    $query = $this->sp->run($para,$sp,$out);
    $id = $query->$out;
    
Right now the function returns data as a stdObj.  In the future, I'd like to extend this to behave as other query results without writing an error to the log.

I haven't tried this with any database other than MySQL.
