## `set_headers`

### Description
Function starts with: @header('Content-Type: text/html; charset=' . datalist_db_encoding); ; // @header('X-Frame-Options: SAMEORIGIN'); // deprecated

### Parameters
This function takes no parameters.

### Return Value
- **Type**: `void`
- **Description**: This function does not return a value.

### How it Works
A relatively short function. Details about internal logic are inferred from the code.

### Examples of Usage
```php
set_headers();
```

### See Also
[`application_url()`](#application_url)


---

## `get_tables_info`

### Description
Function starts with: static $all_tables = [], $accessible_tables = []; ; /* return cached results, if found */

### Parameters
- **Name**: `$skip_authentication`
  - **Type**: `mixed`
  - **Description**: Optional. Default: false.
  - **Example / Default**: `false`


### Return Value
- **Type**: `mixed`
- **Description**: Returns different values based on conditions.

### How it Works
Details about internal logic are inferred from the code. Contains loop(s) for iteration. Uses conditional logic.

### Examples of Usage
```php
get_tables_info(false);
```

### See Also
[`getLoggedAdmin()`](#getloggedadmin)


---

## `getTableList`

### Description
Function starts with: $arrAccessTables = []; ; $arrTables = [

### Parameters
- **Name**: `$skip_authentication`
  - **Type**: `mixed`
  - **Description**: Optional. Default: false.
  - **Example / Default**: `false`

- **Name**: `$include_internal_tables`
  - **Type**: `mixed`
  - **Description**: Optional. Default: false.
  - **Example / Default**: `false`


### Return Value
- **Type**: `mixed`
- **Description**: Returns different values based on conditions.

### How it Works
Details about internal logic are inferred from the code. Contains loop(s) for iteration. Uses conditional logic.

### Examples of Usage
```php
getTableList(false, false);
```

### See Also
[`getLoggedAdmin()`](#getloggedadmin)


---

## `getThumbnailSpecs`

### Description
Function starts with: if($tableName=='employees' && $fieldName=='Photo' && $view=='tv') ; return ['width'=>50, 'height'=>50, 'identifier'=>'_tv'];

### Parameters
- **Name**: `$tableName`
  - **Type**: `mixed`
  - **Description**: N/A
  - **Example / Default**: `null`

- **Name**: `$fieldName`
  - **Type**: `mixed`
  - **Description**: N/A
  - **Example / Default**: `null`

- **Name**: `$view`
  - **Type**: `mixed`
  - **Description**: N/A
  - **Example / Default**: `null`


### Return Value
- **Type**: `mixed`
- **Description**: Returns different values based on conditions.

### How it Works
A relatively short function. Details about internal logic are inferred from the code. Uses conditional logic.

### Examples of Usage
```php
getThumbnailSpecs(null, null, null);
```

### See Also
None.


---

## `createThumbnail`

### Description
Alias for `Thumbnail::create()`. Create a thumbnail of an image. The thumbnail is saved in the same directory as the original image, with the same name, suffixed with `$specs['identifier']`

### Parameters
- **Name**: `$img`
  - **Type**: `string`
  - **Description**: - path to image file
  - **Example / Default**: `''`

- **Name**: `$specs`
  - **Type**: `array`
  - **Description**: - array with thumbnail specs as returned by getThumbnailSpecs()
  - **Example / Default**: `[]`


### Return Value
- **Type**: `bool`
- **Description**: - true on success, false on failure

### How it Works
A relatively short function. Details about internal logic are inferred from the code.

### Examples of Usage
```php
createThumbnail('', []);
```

### See Also
None.


---

## `formatUri`

### Description
Function starts with: $uri = str_replace('\\', '/', $uri); ; return trim($uri, '/');

### Parameters
- **Name**: `$uri`
  - **Type**: `mixed`
  - **Description**: N/A
  - **Example / Default**: `null`


### Return Value
- **Type**: `mixed`
- **Description**: Returns a literal value: trim($uri, '/')

### How it Works
A relatively short function. Details about internal logic are inferred from the code.

### Examples of Usage
```php
formatUri(null);
```

### See Also
None.


---

## `makeSafe`

### Description
Function starts with: static $cached = []; /* str => escaped_str */ ; if(!strlen($string)) return '';

### Parameters
- **Name**: `$string`
  - **Type**: `mixed`
  - **Description**: N/A
  - **Example / Default**: `null`

- **Name**: `$is_gpc`
  - **Type**: `mixed`
  - **Description**: Optional. Default: true.
  - **Example / Default**: `true`


### Return Value
- **Type**: `mixed`
- **Description**: Returns different values based on conditions.

### How it Works
Details about internal logic are inferred from the code. Involves database operations. Uses conditional logic.

### Examples of Usage
```php
makeSafe(null, true);
```

### See Also
[`sql()`](#sql)


---

## `checkPermissionVal`

### Description
Function starts with: // fn to make sure the value in the given POST variable is 0, 1, 2 or 3 ; // if the value is invalid, it default to 0

### Parameters
- **Name**: `$pvn`
  - **Type**: `mixed`
  - **Description**: N/A
  - **Example / Default**: `null`


### Return Value
- **Type**: `mixed`
- **Description**: Returns different values based on conditions.

### How it Works
Details about internal logic are inferred from the code. Uses conditional logic.

### Examples of Usage
```php
checkPermissionVal(null);
```

### See Also
None.


---

## `dieErrorPage`

### Description
Function starts with: global $Translation; ; $header = (defined('ADMIN_AREA') ? __DIR__ . '/incHeader.php' : __DIR__ . '/../header.php');

### Parameters
- **Name**: `$error`
  - **Type**: `mixed`
  - **Description**: N/A
  - **Example / Default**: `null`


### Return Value
- **Type**: `void`
- **Description**: This function does not return a value.

### How it Works
Details about internal logic are inferred from the code.

### Examples of Usage
```php
dieErrorPage(null);
```

### See Also
None.


---

## `openDBConnection`

### Description
Function starts with: static $connected = false, $db_link; ; $dbServer = config('dbServer');

### Parameters
- **Name**: `$o`
  - **Type**: `mixed`
  - **Description**: N/A
  - **Example / Default**: `null`


### Return Value
- **Type**: `mixed`
- **Description**: Returns different values based on conditions.

### How it Works
Details about internal logic are inferred from the code. Uses conditional logic.

### Examples of Usage
```php
openDBConnection(null);
```

### See Also
[`dieErrorPage()`](#dieerrorpage)


---

## `sql`

### Description
Function starts with: /* ; Supported options that can be passed in $o options array (as array keys):

### Parameters
- **Name**: `$statement`
  - **Type**: `mixed`
  - **Description**: N/A
  - **Example / Default**: `null`

- **Name**: `$o`
  - **Type**: `mixed`
  - **Description**: N/A
  - **Example / Default**: `null`


### Return Value
- **Type**: `mixed`
- **Description**: Returns different values based on conditions.

### How it Works
Details about internal logic are inferred from the code. Involves database operations. Uses conditional logic.

### Examples of Usage
```php
sql(null, null);
```

### See Also
[`application_url()`](#application_url), [`logErrorQuery()`](#logerrorquery), [`openDBConnection()`](#opendbconnection), [`logSlowQuery()`](#logslowquery), [`dieErrorPage()`](#dieerrorpage), [`getLoggedAdmin()`](#getloggedadmin)


---

## `logSlowQuery`

### Description
Function starts with: if(!createQueryLogTable()) return; ; $o = [

### Parameters
- **Name**: `$statement`
  - **Type**: `mixed`
  - **Description**: N/A
  - **Example / Default**: `null`

- **Name**: `$duration`
  - **Type**: `mixed`
  - **Description**: N/A
  - **Example / Default**: `null`


### Return Value
- **Type**: `void`
- **Description**: This function does not return a value.

### How it Works
Details about internal logic are inferred from the code. Involves database operations. Uses conditional logic.

### Examples of Usage
```php
logSlowQuery(null, null);
```

### See Also
[`stripParams()`](#stripparams), [`createQueryLogTable()`](#createquerylogtable), [`sql()`](#sql), [`makeSafe()`](#makesafe)


---

## `logErrorQuery`

### Description
Function starts with: if(!createQueryLogTable()) return; ; $o = [

### Parameters
- **Name**: `$statement`
  - **Type**: `mixed`
  - **Description**: N/A
  - **Example / Default**: `null`

- **Name**: `$error`
  - **Type**: `mixed`
  - **Description**: N/A
  - **Example / Default**: `null`


### Return Value
- **Type**: `void`
- **Description**: This function does not return a value.

### How it Works
Details about internal logic are inferred from the code. Involves database operations. Uses conditional logic.

### Examples of Usage
```php
logErrorQuery(null, null);
```

### See Also
[`stripParams()`](#stripparams), [`createQueryLogTable()`](#createquerylogtable), [`sql()`](#sql), [`makeSafe()`](#makesafe)


---

## `stripParams`

### Description
Strip specified parameters from a URL

### Parameters
- **Name**: `$uri`
  - **Type**: `string`
  - **Description**: - the URL to strip parameters from, could be a full URL or just a URI
  - **Example / Default**: `''`

- **Name**: `$paramsToRemove`
  - **Type**: `array`
  - **Description**: - an array of parameter names to remove
  - **Example / Default**: `[]`


### Return Value
- **Type**: `string`
- **Description**: - the URL with specified parameters removed

### How it Works
Details about internal logic are inferred from the code.

### Examples of Usage
```php
stripParams('', []);
```

### See Also
None.


---

## `createQueryLogTable`

### Description
Function starts with: static $created = false; ; if($created) return true;

### Parameters
This function takes no parameters.

### Return Value
- **Type**: `mixed`
- **Description**: Returns different values based on conditions.

### How it Works
A relatively short function. Details about internal logic are inferred from the code. Uses conditional logic.

### Examples of Usage
```php
createQueryLogTable();
```

### See Also
[`createTableIfNotExists()`](#createtableifnotexists)


---

## `sqlValue`

### Description
Function starts with: // executes a statement that retreives a single data value and returns the value retrieved ; $eo = ['silentErrors' => true];

### Parameters
- **Name**: `$statement`
  - **Type**: `mixed`
  - **Description**: N/A
  - **Example / Default**: `null`

- **Name**: `$error`
  - **Type**: `mixed`
  - **Description**: Optional. Default: NULL.
  - **Example / Default**: `NULL`


### Return Value
- **Type**: `mixed`
- **Description**: Returns different values based on conditions.

### How it Works
A relatively short function. Details about internal logic are inferred from the code. Involves database operations. Uses conditional logic.

### Examples of Usage
```php
sqlValue(null, NULL);
```

### See Also
[`sql()`](#sql)


---

## `getLoggedAdmin`

### Description
Function starts with: return Authentication::getAdmin();

### Parameters
This function takes no parameters.

### Return Value
- **Type**: `mixed`
- **Description**: Returns the result of: Authentication::getAdmin()

### How it Works
A relatively short function. Details about internal logic are inferred from the code.

### Examples of Usage
```php
getLoggedAdmin();
```

### See Also
None.


---

## `initSession`

### Description
Function starts with: Authentication::initSession();

### Parameters
This function takes no parameters.

### Return Value
- **Type**: `void`
- **Description**: This function does not return a value.

### How it Works
A relatively short function. Details about internal logic are inferred from the code.

### Examples of Usage
```php
initSession();
```

### See Also
None.


---

## `jwt_key`

### Description
Function starts with: if(!is_file(configFileName())) return false; ; return md5_file(configFileName());

### Parameters
This function takes no parameters.

### Return Value
- **Type**: `mixed`
- **Description**: Returns different values based on conditions.

### How it Works
A relatively short function. Details about internal logic are inferred from the code. Uses conditional logic.

### Examples of Usage
```php
jwt_key();
```

### See Also
None.


---

## `jwt_token`

### Description
Function starts with: if($user === false) { ; $mi = Authentication::getUser();

### Parameters
- **Name**: `$user`
  - **Type**: `mixed`
  - **Description**: Optional. Default: false.
  - **Example / Default**: `false`


### Return Value
- **Type**: `mixed`
- **Description**: Returns different values based on conditions.

### How it Works
Details about internal logic are inferred from the code. Uses conditional logic.

### Examples of Usage
```php
jwt_token(false);
```

### See Also
[`jwt_key()`](#jwt_key)


---

## `jwt_header`

### Description
Function starts with: /* adapted from https://stackoverflow.com/a/40582472/1945185 */ ; $auth_header = null;

### Parameters
This function takes no parameters.

### Return Value
- **Type**: `mixed`
- **Description**: Returns different values based on conditions.

### How it Works
Details about internal logic are inferred from the code. Uses conditional logic.

### Examples of Usage
```php
jwt_header();
```

### See Also
None.


---

## `jwt_check_login`

### Description
Function starts with: // do we have an Authorization Bearer header? ; $token = jwt_header();

### Parameters
This function takes no parameters.

### Return Value
- **Type**: `mixed`
- **Description**: Returns different values based on conditions.

### How it Works
Details about internal logic are inferred from the code. Uses conditional logic.

### Examples of Usage
```php
jwt_check_login();
```

### See Also
[`jwt_header()`](#jwt_header), [`jwt_key()`](#jwt_key)


---

## `curl_insert_handler`

### Description
Function starts with: if(!function_exists('curl_init')) return false; ; $ch = curl_init();

### Parameters
- **Name**: `$table`
  - **Type**: `mixed`
  - **Description**: N/A
  - **Example / Default**: `null`

- **Name**: `$data`
  - **Type**: `mixed`
  - **Description**: N/A
  - **Example / Default**: `null`


### Return Value
- **Type**: `mixed`
- **Description**: Returns different values based on conditions.

### How it Works
Details about internal logic are inferred from the code. Uses conditional logic.

### Examples of Usage
```php
curl_insert_handler(null, null);
```

### See Also
[`application_url()`](#application_url), [`jwt_token()`](#jwt_token)


---

## `curl_batch`

### Description
Function starts with: if(!function_exists('curl_init')) return false; ; if(!is_array($handlers)) return false;

### Parameters
- **Name**: `$handlers`
  - **Type**: `mixed`
  - **Description**: N/A
  - **Example / Default**: `null`


### Return Value
- **Type**: `mixed`
- **Description**: Returns different values based on conditions.

### How it Works
Details about internal logic are inferred from the code. Contains loop(s) for iteration. Uses conditional logic.

### Examples of Usage
```php
curl_batch(null);
```

### See Also
None.


---

## `logOutUser`

### Description
Function starts with: RememberMe::logout();

### Parameters
This function takes no parameters.

### Return Value
- **Type**: `void`
- **Description**: This function does not return a value.

### How it Works
A relatively short function. Details about internal logic are inferred from the code.

### Examples of Usage
```php
logOutUser();
```

### See Also
None.


---

## `getPKFieldName`

### Description
Function starts with: // get pk field name of given table ; static $pk = [];

### Parameters
- **Name**: `$tn`
  - **Type**: `mixed`
  - **Description**: N/A
  - **Example / Default**: `null`


### Return Value
- **Type**: `mixed`
- **Description**: Returns different values based on conditions.

### How it Works
Details about internal logic are inferred from the code. Involves database operations. Contains loop(s) for iteration. Uses conditional logic.

### Examples of Usage
```php
getPKFieldName(null);
```

### See Also
[`sql()`](#sql), [`makeSafe()`](#makesafe)


---

## `getCSVData`

### Description
Function starts with: // get pk field name for given table ; if(!$pkField = getPKFieldName($tn))

### Parameters
- **Name**: `$tn`
  - **Type**: `mixed`
  - **Description**: N/A
  - **Example / Default**: `null`

- **Name**: `$pkValue`
  - **Type**: `mixed`
  - **Description**: N/A
  - **Example / Default**: `null`

- **Name**: `$stripTags`
  - **Type**: `mixed`
  - **Description**: Optional. Default: true.
  - **Example / Default**: `true`


### Return Value
- **Type**: `mixed`
- **Description**: Returns different values based on conditions.

### How it Works
Details about internal logic are inferred from the code. Involves database operations. Contains loop(s) for iteration. Uses conditional logic.

### Examples of Usage
```php
getCSVData(null, null, true);
```

### See Also
[`sql()`](#sql), [`sqlValue()`](#sqlvalue), [`getPKFieldName()`](#getpkfieldname), [`makeSafe()`](#makesafe)


---

## `errorMsg`

### Description
Function starts with: echo "<div class=\"alert alert-danger\">{$msg}</div>";

### Parameters
- **Name**: `$msg`
  - **Type**: `mixed`
  - **Description**: N/A
  - **Example / Default**: `null`


### Return Value
- **Type**: `void`
- **Description**: This function does not return a value.

### How it Works
A relatively short function. Details about internal logic are inferred from the code.

### Examples of Usage
```php
errorMsg(null);
```

### See Also
None.


---

## `redirect`

### Description
Function starts with: $fullURL = ($absolute ? $url : application_url($url)); ; // append browser window id to url (check if it should be preceded by ? or &)

### Parameters
- **Name**: `$url`
  - **Type**: `mixed`
  - **Description**: N/A
  - **Example / Default**: `null`

- **Name**: `$absolute`
  - **Type**: `mixed`
  - **Description**: Optional. Default: false.
  - **Example / Default**: `false`


### Return Value
- **Type**: `void`
- **Description**: This function does not return a value.

### How it Works
Details about internal logic are inferred from the code. Uses conditional logic.

### Examples of Usage
```php
redirect(null, false);
```

### See Also
[`application_url()`](#application_url)


---

## `htmlRadioGroup`

### Description
Function starts with: if(!is_array($arrValue)) return ''; ; ob_start();

### Parameters
- **Name**: `$name`
  - **Type**: `mixed`
  - **Description**: N/A
  - **Example / Default**: `null`

- **Name**: `$arrValue`
  - **Type**: `mixed`
  - **Description**: N/A
  - **Example / Default**: `null`

- **Name**: `$arrCaption`
  - **Type**: `mixed`
  - **Description**: N/A
  - **Example / Default**: `null`

- **Name**: `$selectedValue`
  - **Type**: `mixed`
  - **Description**: N/A
  - **Example / Default**: `null`

- **Name**: `$selClass`
  - **Type**: `mixed`
  - **Description**: Optional. Default: 'text-primary'.
  - **Example / Default**: `'text-primary'`

- **Name**: `$class`
  - **Type**: `mixed`
  - **Description**: Optional. Default: ''.
  - **Example / Default**: `''`

- **Name**: `$separator`
  - **Type**: `mixed`
  - **Description**: Optional. Default: '<br>'.
  - **Example / Default**: `'<br>'`


### Return Value
- **Type**: `mixed`
- **Description**: Returns different values based on conditions.

### How it Works
Details about internal logic are inferred from the code. Contains loop(s) for iteration. Uses conditional logic.

### Examples of Usage
```php
htmlRadioGroup(null, null, null, null, 'text-primary', '', '<br>');
```

### See Also
[`html_attr()`](#html_attr)


---

## `htmlSelect`

### Description
Function starts with: if($selectedClass == '') ; $selectedClass = $class;

### Parameters
- **Name**: `$name`
  - **Type**: `mixed`
  - **Description**: N/A
  - **Example / Default**: `null`

- **Name**: `$arrValue`
  - **Type**: `mixed`
  - **Description**: N/A
  - **Example / Default**: `null`

- **Name**: `$arrCaption`
  - **Type**: `mixed`
  - **Description**: N/A
  - **Example / Default**: `null`

- **Name**: `$selectedValue`
  - **Type**: `mixed`
  - **Description**: N/A
  - **Example / Default**: `null`

- **Name**: `$class`
  - **Type**: `mixed`
  - **Description**: Optional. Default: ''.
  - **Example / Default**: `''`

- **Name**: `$selectedClass`
  - **Type**: `mixed`
  - **Description**: Optional. Default: ''.
  - **Example / Default**: `''`


### Return Value
- **Type**: `mixed`
- **Description**: Returns the result of: $out

### How it Works
Details about internal logic are inferred from the code. Contains loop(s) for iteration. Uses conditional logic.

### Examples of Usage
```php
htmlSelect(null, null, null, null, '', '');
```

### See Also
None.


---

## `htmlSQLSelect`

### Description
Function starts with: $arrVal = ['']; ; $arrCap = [''];

### Parameters
- **Name**: `$name`
  - **Type**: `mixed`
  - **Description**: N/A
  - **Example / Default**: `null`

- **Name**: `$sql_param`
  - **Type**: `mixed`
  - **Description**: N/A
  - **Example / Default**: `null`

- **Name**: `$selectedValue`
  - **Type**: `mixed`
  - **Description**: N/A
  - **Example / Default**: `null`

- **Name**: `$class`
  - **Type**: `mixed`
  - **Description**: Optional. Default: ''.
  - **Example / Default**: `''`

- **Name**: `$selectedClass`
  - **Type**: `mixed`
  - **Description**: Optional. Default: ''.
  - **Example / Default**: `''`


### Return Value
- **Type**: `mixed`
- **Description**: Returns different values based on conditions.

### How it Works
Details about internal logic are inferred from the code. Involves database operations. Contains loop(s) for iteration. Uses conditional logic.

### Examples of Usage
```php
htmlSQLSelect(null, null, null, '', '');
```

### See Also
[`sql()`](#sql), [`htmlSelect()`](#htmlselect)


---

## `bootstrapSelect`

### Description
Function starts with: if($selectedClass == '') $selectedClass = $class; ; $out = "<select class=\"form-control\" name=\"{$name}\" id=\"{$name}\">";

### Parameters
- **Name**: `$name`
  - **Type**: `mixed`
  - **Description**: N/A
  - **Example / Default**: `null`

- **Name**: `$arrValue`
  - **Type**: `mixed`
  - **Description**: N/A
  - **Example / Default**: `null`

- **Name**: `$arrCaption`
  - **Type**: `mixed`
  - **Description**: N/A
  - **Example / Default**: `null`

- **Name**: `$selectedValue`
  - **Type**: `mixed`
  - **Description**: N/A
  - **Example / Default**: `null`

- **Name**: `$class`
  - **Type**: `mixed`
  - **Description**: Optional. Default: ''.
  - **Example / Default**: `''`

- **Name**: `$selectedClass`
  - **Type**: `mixed`
  - **Description**: Optional. Default: ''.
  - **Example / Default**: `''`


### Return Value
- **Type**: `mixed`
- **Description**: Returns the result of: $out

### How it Works
Details about internal logic are inferred from the code. Contains loop(s) for iteration. Uses conditional logic.

### Examples of Usage
```php
bootstrapSelect(null, null, null, null, '', '');
```

### See Also
None.


---

## `bootstrapSQLSelect`

### Description
Function starts with: $arrVal = ['']; ; $arrCap = [''];

### Parameters
- **Name**: `$name`
  - **Type**: `mixed`
  - **Description**: N/A
  - **Example / Default**: `null`

- **Name**: `$sql_param`
  - **Type**: `mixed`
  - **Description**: N/A
  - **Example / Default**: `null`

- **Name**: `$selectedValue`
  - **Type**: `mixed`
  - **Description**: N/A
  - **Example / Default**: `null`

- **Name**: `$class`
  - **Type**: `mixed`
  - **Description**: Optional. Default: ''.
  - **Example / Default**: `''`

- **Name**: `$selectedClass`
  - **Type**: `mixed`
  - **Description**: Optional. Default: ''.
  - **Example / Default**: `''`


### Return Value
- **Type**: `mixed`
- **Description**: Returns different values based on conditions.

### How it Works
Details about internal logic are inferred from the code. Involves database operations. Contains loop(s) for iteration. Uses conditional logic.

### Examples of Usage
```php
bootstrapSQLSelect(null, null, null, '', '');
```

### See Also
[`sql()`](#sql), [`bootstrapSelect()`](#bootstrapselect)


---

## `isEmail`

### Description
Function starts with: if(preg_match('/^([*+!.&#$¦\'\\%\/0-9a-z^_`{}=?~:-]+)@(([0-9a-z-]+\.)+[0-9a-z]{2,30})$/i', $email)) ; return $email;

### Parameters
- **Name**: `$email`
  - **Type**: `mixed`
  - **Description**: N/A
  - **Example / Default**: `null`


### Return Value
- **Type**: `mixed`
- **Description**: Returns different values based on conditions.

### How it Works
A relatively short function. Details about internal logic are inferred from the code. Uses conditional logic.

### Examples of Usage
```php
isEmail(null);
```

### See Also
None.


---

## `notifyMemberApproval`

### Description
Function starts with: $adminConfig = config('adminConfig'); ; $memberID = strtolower($memberID);

### Parameters
- **Name**: `$memberID`
  - **Type**: `mixed`
  - **Description**: N/A
  - **Example / Default**: `null`


### Return Value
- **Type**: `void`
- **Description**: This function does not return a value.

### How it Works
Details about internal logic are inferred from the code. Involves database operations.

### Examples of Usage
```php
notifyMemberApproval(null);
```

### See Also
[`sqlValue()`](#sqlvalue)


---

## `setupMembership`

### Description
Function starts with: if(empty($_SESSION) || empty($_SESSION['memberID'])) return; ; /* abort if current page is one of the following exceptions */

### Parameters
This function takes no parameters.

### Return Value
- **Type**: `void`
- **Description**: This function does not return a value.

### How it Works
Details about internal logic are inferred from the code. Involves database operations. Contains loop(s) for iteration. Uses conditional logic.

### Examples of Usage
```php
setupMembership();
```

### See Also
[`sql()`](#sql), [`configure_anonymous_group()`](#configure_anonymous_group), [`membership_table_functions()`](#membership_table_functions), [`is_ajax()`](#is_ajax), [`configure_admin_group()`](#configure_admin_group)


---

## `membership_table_functions`

### Description
Function starts with: // returns a list of update_membership_* functions ; $arr = get_defined_functions();

### Parameters
This function takes no parameters.

### Return Value
- **Type**: `bool`
- **Description**: Returns a literal value: (strpos($f, 'update_membership_') !== false)

### How it Works
A relatively short function. Details about internal logic are inferred from the code.

### Examples of Usage
```php
membership_table_functions();
```

### See Also
None.


---

## `configure_anonymous_group`

### Description
Function starts with: $eo = ['silentErrors' => true, 'noErrorQueryLog' => true]; ; $adminConfig = config('adminConfig');

### Parameters
This function takes no parameters.

### Return Value
- **Type**: `void`
- **Description**: This function does not return a value.

### How it Works
Details about internal logic are inferred from the code. Involves database operations. Uses conditional logic.

### Examples of Usage
```php
configure_anonymous_group();
```

### See Also
[`sql()`](#sql), [`sqlValue()`](#sqlvalue), [`makeSafe()`](#makesafe)


---

## `configure_admin_group`

### Description
Function starts with: $eo = ['silentErrors' => true, 'noErrorQueryLog' => true]; ; $adminConfig = config('adminConfig');

### Parameters
This function takes no parameters.

### Return Value
- **Type**: `void`
- **Description**: This function does not return a value.

### How it Works
Details about internal logic are inferred from the code. Involves database operations. Contains loop(s) for iteration. Uses conditional logic.

### Examples of Usage
```php
configure_admin_group();
```

### See Also
[`sql()`](#sql), [`sqlValue()`](#sqlvalue), [`getTableList()`](#gettablelist), [`makeSafe()`](#makesafe)


---

## `get_table_keys`

### Description
Function starts with: $keys = []; ; $res = sql("SHOW KEYS FROM `{$tn}`", $eo);

### Parameters
- **Name**: `$tn`
  - **Type**: `mixed`
  - **Description**: N/A
  - **Example / Default**: `null`


### Return Value
- **Type**: `mixed`
- **Description**: Returns the result of: $keys

### How it Works
A relatively short function. Details about internal logic are inferred from the code. Involves database operations. Contains loop(s) for iteration.

### Examples of Usage
```php
get_table_keys(null);
```

### See Also
[`sql()`](#sql)


---

## `get_table_fields`

### Description
Function starts with: static $schema = null, $internalTables = null; ; if($schema === null) {

### Parameters
- **Name**: `$tn`
  - **Type**: `mixed`
  - **Description**: Optional. Default: null.
  - **Example / Default**: `null`

- **Name**: `$include_internal_tables`
  - **Type**: `mixed`
  - **Description**: Optional. Default: false.
  - **Example / Default**: `false`


### Return Value
- **Type**: `mixed`
- **Description**: Returns different values based on conditions.

### How it Works
Details about internal logic are inferred from the code. Contains loop(s) for iteration. Uses conditional logic.

### Examples of Usage
```php
get_table_fields(null, false);
```

### See Also
None.


---

## `updateField`

### Description
Function starts with: $sqlNull = $notNull ? 'NOT NULL' : 'NULL'; ; $sqlDefault = $default === null ? '' : "DEFAULT '" . makeSafe($default) . "'";

### Parameters
- **Name**: `$tn`
  - **Type**: `mixed`
  - **Description**: N/A
  - **Example / Default**: `null`

- **Name**: `$fn`
  - **Type**: `mixed`
  - **Description**: N/A
  - **Example / Default**: `null`

- **Name**: `$dataType`
  - **Type**: `mixed`
  - **Description**: N/A
  - **Example / Default**: `null`

- **Name**: `$notNull`
  - **Type**: `mixed`
  - **Description**: Optional. Default: false.
  - **Example / Default**: `false`

- **Name**: `$default_value`
  - **Type**: `mixed`
  - **Description**: Optional. Default: null.
  - **Example / Default**: `null`

- **Name**: `$extra`
  - **Type**: `mixed`
  - **Description**: Optional. Default: null.
  - **Example / Default**: `null`


### Return Value
- **Type**: `void`
- **Description**: This function does not return a value.

### How it Works
Details about internal logic are inferred from the code. Involves database operations. Uses conditional logic.

### Examples of Usage
```php
updateField(null, null, null, false, null, null);
```

### See Also
[`sql()`](#sql), [`makeSafe()`](#makesafe)


---

## `addIndex`

### Description
Function starts with: // if $fields is a string, convert it to an array ; if(!is_array($fields)) $fields = [$fields];

### Parameters
- **Name**: `$tn`
  - **Type**: `mixed`
  - **Description**: N/A
  - **Example / Default**: `null`

- **Name**: `$fields`
  - **Type**: `mixed`
  - **Description**: N/A
  - **Example / Default**: `null`

- **Name**: `$unique`
  - **Type**: `mixed`
  - **Description**: Optional. Default: false.
  - **Example / Default**: `false`


### Return Value
- **Type**: `void`
- **Description**: This function does not return a value.

### How it Works
Details about internal logic are inferred from the code. Involves database operations. Contains loop(s) for iteration. Uses conditional logic.

### Examples of Usage
```php
addIndex(null, null, false);
```

### See Also
[`sql()`](#sql)


---

## `createTableIfNotExists`

### Description
Function starts with: $schema = get_table_fields($tn); ; if(!$schema) return false;

### Parameters
- **Name**: `$tn`
  - **Type**: `mixed`
  - **Description**: N/A
  - **Example / Default**: `null`

- **Name**: `$return_schema_without_executing`
  - **Type**: `mixed`
  - **Description**: Optional. Default: false.
  - **Example / Default**: `false`


### Return Value
- **Type**: `mixed`
- **Description**: Returns different values based on conditions.

### How it Works
Details about internal logic are inferred from the code. Involves database operations. Contains loop(s) for iteration. Uses conditional logic.

### Examples of Usage
```php
createTableIfNotExists(null, false);
```

### See Also
[`sql()`](#sql), [`get_table_fields()`](#get_table_fields)


---

## `update_membership_groups`

### Description
Function starts with: $tn = 'membership_groups'; ; createTableIfNotExists($tn);

### Parameters
This function takes no parameters.

### Return Value
- **Type**: `void`
- **Description**: This function does not return a value.

### How it Works
A relatively short function. Details about internal logic are inferred from the code.

### Examples of Usage
```php
update_membership_groups();
```

### See Also
[`updateField()`](#updatefield), [`createTableIfNotExists()`](#createtableifnotexists), [`addIndex()`](#addindex)


---

## `update_membership_users`

### Description
Function starts with: $tn = 'membership_users'; ; createTableIfNotExists($tn);

### Parameters
This function takes no parameters.

### Return Value
- **Type**: `void`
- **Description**: This function does not return a value.

### How it Works
Details about internal logic are inferred from the code.

### Examples of Usage
```php
update_membership_users();
```

### See Also
[`updateField()`](#updatefield), [`createTableIfNotExists()`](#createtableifnotexists), [`addIndex()`](#addindex)


---

## `update_membership_userrecords`

### Description
Function starts with: $tn = 'membership_userrecords'; ; createTableIfNotExists($tn);

### Parameters
This function takes no parameters.

### Return Value
- **Type**: `void`
- **Description**: This function does not return a value.

### How it Works
Details about internal logic are inferred from the code.

### Examples of Usage
```php
update_membership_userrecords();
```

### See Also
[`updateField()`](#updatefield), [`createTableIfNotExists()`](#createtableifnotexists), [`addIndex()`](#addindex)


---

## `update_membership_grouppermissions`

### Description
Function starts with: $tn = 'membership_grouppermissions'; ; createTableIfNotExists($tn);

### Parameters
This function takes no parameters.

### Return Value
- **Type**: `void`
- **Description**: This function does not return a value.

### How it Works
A relatively short function. Details about internal logic are inferred from the code.

### Examples of Usage
```php
update_membership_grouppermissions();
```

### See Also
[`createTableIfNotExists()`](#createtableifnotexists), [`addIndex()`](#addindex)


---

## `update_membership_userpermissions`

### Description
Function starts with: $tn = 'membership_userpermissions'; ; createTableIfNotExists($tn);

### Parameters
This function takes no parameters.

### Return Value
- **Type**: `void`
- **Description**: This function does not return a value.

### How it Works
A relatively short function. Details about internal logic are inferred from the code.

### Examples of Usage
```php
update_membership_userpermissions();
```

### See Also
[`updateField()`](#updatefield), [`createTableIfNotExists()`](#createtableifnotexists), [`addIndex()`](#addindex)


---

## `update_membership_usersessions`

### Description
Function starts with: $tn = 'membership_usersessions'; ; // not using createTableIfNotExists() here because we need to add a composite unique index,

### Parameters
This function takes no parameters.

### Return Value
- **Type**: `void`
- **Description**: This function does not return a value.

### How it Works
Details about internal logic are inferred from the code. Involves database operations.

### Examples of Usage
```php
update_membership_usersessions();
```

### See Also
[`sql()`](#sql), [`createTableIfNotExists()`](#createtableifnotexists)


---

## `update_membership_cache`

### Description
Function starts with: $tn = 'membership_cache'; ; createTableIfNotExists($tn);

### Parameters
This function takes no parameters.

### Return Value
- **Type**: `void`
- **Description**: This function does not return a value.

### How it Works
A relatively short function. Details about internal logic are inferred from the code.

### Examples of Usage
```php
update_membership_cache();
```

### See Also
[`updateField()`](#updatefield), [`createTableIfNotExists()`](#createtableifnotexists)


---

## `thisOr`

### Description
Function starts with: return ($this_val != '' ? $this_val : $or);

### Parameters
- **Name**: `$this_val`
  - **Type**: `mixed`
  - **Description**: N/A
  - **Example / Default**: `null`

- **Name**: `$or_param`
  - **Type**: `mixed`
  - **Description**: Optional. Default: '&nbsp;'.
  - **Example / Default**: `'&nbsp;'`


### Return Value
- **Type**: `mixed`
- **Description**: Returns a literal value: ($this_val != '' ? $this_val : $or)

### How it Works
A relatively short function. Details about internal logic are inferred from the code.

### Examples of Usage
```php
thisOr(null, '&nbsp;');
```

### See Also
None.


---

## `getUploadedFile`

### Description
Function starts with: if(empty($_FILES) || empty($_FILES[$FieldName])) ; return 'Your php settings don\'t allow file uploads.';

### Parameters
- **Name**: `$FieldName`
  - **Type**: `mixed`
  - **Description**: N/A
  - **Example / Default**: `null`

- **Name**: `$MaxSize`
  - **Type**: `mixed`
  - **Description**: Optional. Default: 0.
  - **Example / Default**: `0`

- **Name**: `$FileTypes`
  - **Type**: `mixed`
  - **Description**: Optional. Default: 'csv|txt'.
  - **Example / Default**: `'csv|txt'`

- **Name**: `$NoRename`
  - **Type**: `mixed`
  - **Description**: Optional. Default: false.
  - **Example / Default**: `false`

- **Name**: `$dir`
  - **Type**: `mixed`
  - **Description**: Optional. Default: ''.
  - **Example / Default**: `''`


### Return Value
- **Type**: `mixed`
- **Description**: Returns different values based on conditions.

### How it Works
Details about internal logic are inferred from the code. Uses conditional logic.

### Examples of Usage
```php
getUploadedFile(null, 0, 'csv|txt', false, '');
```

### See Also
[`toBytes()`](#tobytes)


---

## `toBytes`

### Description
Function starts with: $val = trim($val); ; $last = strtolower($val[strlen($val) - 1]);

### Parameters
- **Name**: `$val`
  - **Type**: `mixed`
  - **Description**: N/A
  - **Example / Default**: `null`


### Return Value
- **Type**: `mixed`
- **Description**: Returns the result of: $val

### How it Works
Details about internal logic are inferred from the code.

### Examples of Usage
```php
toBytes(null);
```

### See Also
None.


---

## `convertLegacyOptions`

### Description
Function starts with: $CSVList=str_replace(';;;', ';||', $CSVList); ; $CSVList=str_replace(';;', '||', $CSVList);

### Parameters
- **Name**: `$CSVList`
  - **Type**: `mixed`
  - **Description**: N/A
  - **Example / Default**: `null`


### Return Value
- **Type**: `mixed`
- **Description**: Returns a literal value: trim($CSVList, '|')

### How it Works
A relatively short function. Details about internal logic are inferred from the code.

### Examples of Usage
```php
convertLegacyOptions(null);
```

### See Also
None.


---

## `getValueGivenCaption`

### Description
Function starts with: if(!preg_match('/select\s+(.*?)\s*,\s*(.*?)\s+from\s+(.*?)\s+order by.*/i', $query, $m)) { ; if(!preg_match('/select\s+(.*?)\s*,\s*(.*?)\s+from\s+(.*)/i', $query, $m)) {

### Parameters
- **Name**: `$query`
  - **Type**: `mixed`
  - **Description**: N/A
  - **Example / Default**: `null`

- **Name**: `$caption`
  - **Type**: `mixed`
  - **Description**: N/A
  - **Example / Default**: `null`


### Return Value
- **Type**: `mixed`
- **Description**: Returns different values based on conditions.

### How it Works
Details about internal logic are inferred from the code. Involves database operations. Uses conditional logic.

### Examples of Usage
```php
getValueGivenCaption(null, null);
```

### See Also
[`sqlValue()`](#sqlvalue), [`makeSafe()`](#makesafe)


---

## `time24`

### Description
Function starts with: if($t === false) $t = date('Y-m-d H:i:s'); // time now if $t not passed ; elseif(!$t) return ''; // empty string if $t empty

### Parameters
- **Name**: `$t`
  - **Type**: `mixed`
  - **Description**: Optional. Default: false.
  - **Example / Default**: `false`


### Return Value
- **Type**: `mixed`
- **Description**: Returns different values based on conditions.

### How it Works
A relatively short function. Details about internal logic are inferred from the code. Uses conditional logic.

### Examples of Usage
```php
time24(false);
```

### See Also
None.


---

## `time12`

### Description
Function starts with: if($t === false) $t = date('Y-m-d H:i:s'); // time now if $t not passed ; elseif(!$t) return ''; // empty string if $t empty

### Parameters
- **Name**: `$t`
  - **Type**: `mixed`
  - **Description**: Optional. Default: false.
  - **Example / Default**: `false`


### Return Value
- **Type**: `mixed`
- **Description**: Returns different values based on conditions.

### How it Works
A relatively short function. Details about internal logic are inferred from the code. Uses conditional logic.

### Examples of Usage
```php
time12(false);
```

### See Also
None.


---

## `normalize_path`

### Description
Function starts with: // Adapted from https://developer.wordpress.org/reference/functions/wp_normalize_path/ ; // Standardise all paths to use /

### Parameters
- **Name**: `$path`
  - **Type**: `mixed`
  - **Description**: N/A
  - **Example / Default**: `null`


### Return Value
- **Type**: `mixed`
- **Description**: Returns the result of: $path

### How it Works
Details about internal logic are inferred from the code. Uses conditional logic.

### Examples of Usage
```php
normalize_path(null);
```

### See Also
None.


---

## `application_url`

### Description
Function starts with: if($s === false) $s = $_SERVER; ; $ssl = (

### Parameters
- **Name**: `$page`
  - **Type**: `mixed`
  - **Description**: Optional. Default: ''.
  - **Example / Default**: `''`

- **Name**: `$s_param`
  - **Type**: `mixed`
  - **Description**: Optional. Default: false.
  - **Example / Default**: `false`


### Return Value
- **Type**: `string`
- **Description**: Returns a literal value: "{$http}//{$host}{$uri}{$page}"

### How it Works
Details about internal logic are inferred from the code. Uses conditional logic.

### Examples of Usage
```php
application_url('', false);
```

### See Also
None.


---

## `application_uri`

### Description
Function starts with: $url = application_url($page); ; return trim(parse_url($url, PHP_URL_PATH), '/');

### Parameters
- **Name**: `$page`
  - **Type**: `mixed`
  - **Description**: Optional. Default: ''.
  - **Example / Default**: `''`


### Return Value
- **Type**: `mixed`
- **Description**: Returns a literal value: trim(parse_url($url, PHP_URL_PATH), '/')

### How it Works
A relatively short function. Details about internal logic are inferred from the code.

### Examples of Usage
```php
application_uri('');
```

### See Also
[`application_url()`](#application_url)


---

## `is_ajax`

### Description
Function starts with: return (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');

### Parameters
This function takes no parameters.

### Return Value
- **Type**: `mixed`
- **Description**: Returns a literal value: (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')

### How it Works
A relatively short function. Details about internal logic are inferred from the code.

### Examples of Usage
```php
is_ajax();
```

### See Also
None.


---

## `is_allowed_username`

### Description
Function starts with: $username = trim(strtolower($username)); ; if(!preg_match('/^[a-z0-9][a-z0-9 _.@]{3,100}$/', $username) || preg_match('/(@@|  |\.\.|___)/', $username)) return false;

### Parameters
- **Name**: `$username`
  - **Type**: `mixed`
  - **Description**: N/A
  - **Example / Default**: `null`

- **Name**: `$exception`
  - **Type**: `mixed`
  - **Description**: Optional. Default: false.
  - **Example / Default**: `false`


### Return Value
- **Type**: `mixed`
- **Description**: Returns different values based on conditions.

### How it Works
A relatively short function. Details about internal logic are inferred from the code. Involves database operations. Uses conditional logic.

### Examples of Usage
```php
is_allowed_username(null, false);
```

### See Also
[`sqlValue()`](#sqlvalue)


---

## `csrf_token`

### Description
Function starts with: // a long token age is better for UX with SPA and browser back/forward buttons ; // and it would expire when the session ends anyway

### Parameters
- **Name**: `$validate`
  - **Type**: `mixed`
  - **Description**: Optional. Default: false.
  - **Example / Default**: `false`

- **Name**: `$token_only`
  - **Type**: `mixed`
  - **Description**: Optional. Default: false.
  - **Example / Default**: `false`


### Return Value
- **Type**: `mixed`
- **Description**: Returns different values based on conditions.

### How it Works
Details about internal logic are inferred from the code. Uses conditional logic.

### Examples of Usage
```php
csrf_token(false, false);
```

### See Also
None.


---

## `get_plugins`

### Description
Function starts with: $plugins = []; ; $plugins_path = __DIR__ . '/../plugins/';

### Parameters
This function takes no parameters.

### Return Value
- **Type**: `mixed`
- **Description**: Returns different values based on conditions.

### How it Works
Details about internal logic are inferred from the code. Contains loop(s) for iteration. Uses conditional logic.

### Examples of Usage
```php
get_plugins();
```

### See Also
None.


---

## `maintenance_mode`

### Description
Function starts with: $maintenance_file = __DIR__ . '/.maintenance'; ; if($new_status === true) {

### Parameters
- **Name**: `$new_status`
  - **Type**: `mixed`
  - **Description**: Optional. Default: ''.
  - **Example / Default**: `''`


### Return Value
- **Type**: `mixed`
- **Description**: Returns a literal value: is_file($maintenance_file)

### How it Works
Details about internal logic are inferred from the code. Uses conditional logic.

### Examples of Usage
```php
maintenance_mode('');
```

### See Also
None.


---

## `handle_maintenance`

### Description
Function starts with: if(!maintenance_mode()) return; ; global $Translation;

### Parameters
- **Name**: `$echo_param`
  - **Type**: `mixed`
  - **Description**: Optional. Default: false.
  - **Example / Default**: `false`


### Return Value
- **Type**: `mixed`
- **Description**: Returns a literal value: ($echo ? '<div class="alert alert-danger" style="margin: 5em auto -5em

### How it Works
Details about internal logic are inferred from the code. Uses conditional logic.

### Examples of Usage
```php
handle_maintenance(false);
```

### See Also
[`getLoggedAdmin()`](#getloggedadmin), [`maintenance_mode()`](#maintenance_mode)


---

## `html_attr`

### Description
Function starts with: if(version_compare(PHP_VERSION, '5.2.3') >= 0) return htmlspecialchars($str, ENT_QUOTES, datalist_db_encoding, false); ; return htmlspecialchars($str, ENT_QUOTES, datalist_db_encoding);

### Parameters
- **Name**: `$str`
  - **Type**: `mixed`
  - **Description**: N/A
  - **Example / Default**: `null`


### Return Value
- **Type**: `mixed`
- **Description**: Returns different values based on conditions.

### How it Works
A relatively short function. Details about internal logic are inferred from the code. Uses conditional logic.

### Examples of Usage
```php
html_attr(null);
```

### See Also
None.


---

## `html_attr_tags_ok`

### Description
Function starts with: // use this instead of html_attr() if you don't want html tags to be escaped ; $new_str = html_attr($str);

### Parameters
- **Name**: `$str`
  - **Type**: `mixed`
  - **Description**: N/A
  - **Example / Default**: `null`


### Return Value
- **Type**: `mixed`
- **Description**: Returns a literal value: str_replace(['&lt

### How it Works
A relatively short function. Details about internal logic are inferred from the code.

### Examples of Usage
```php
html_attr_tags_ok(null);
```

### See Also
[`html_attr()`](#html_attr)


---

## `prepare_sql_set`

### Description
@brief Prepares data for a SET or WHERE clause, to be used in an INSERT/UPDATE query

### Parameters
- **Name**: `$set_array`
  - **Type**: `[in]`
  - **Description**: Assoc array of field names => values
  - **Example / Default**: `null`

- **Name**: `$glue`
  - **Type**: `[in]`
  - **Description**: optional glue. Set to ' AND ' or ' OR ' if preparing a WHERE clause, or to ',' (default) for a SET clause Optional. Default: ','.
  - **Example / Default**: `', '`


### Return Value
- **Type**: `string`
- **Description**: containing the prepared SET or WHERE clause

### How it Works
Details about internal logic are inferred from the code. Contains loop(s) for iteration. Uses conditional logic.

### Examples of Usage
```php
prepare_sql_set(null, ', ');
```

### See Also
[`makeSafe()`](#makesafe)


---

## `insert`

### Description
@brief Inserts a record to the database

### Parameters
- **Name**: `$tn`
  - **Type**: `[in]`
  - **Description**: table name where the record would be inserted
  - **Example / Default**: `null`

- **Name**: `$set_array`
  - **Type**: `[in]`
  - **Description**: Assoc array of field names => values to be inserted
  - **Example / Default**: `null`

- **Name**: `$error`
  - **Type**: `[out]`
  - **Description**: optional string containing error message if insert fails
  - **Example / Default**: `''`


### Return Value
- **Type**: `boolean`
- **Description**: indicating success/failure

### How it Works
Details about internal logic are inferred from the code. Involves database operations. Uses conditional logic.

### Examples of Usage
```php
insert(null, null, '');
```

### See Also
[`sql()`](#sql), [`prepare_sql_set()`](#prepare_sql_set)


---

## `update`

### Description
@brief Updates a record in the database

### Parameters
- **Name**: `$tn`
  - **Type**: `[in]`
  - **Description**: table name where the record would be updated
  - **Example / Default**: `null`

- **Name**: `$set_array`
  - **Type**: `[in]`
  - **Description**: Assoc array of field names => values to be updated
  - **Example / Default**: `null`

- **Name**: `$where_array`
  - **Type**: `[in]`
  - **Description**: Assoc array of field names => values used to build the WHERE clause
  - **Example / Default**: `null`

- **Name**: `$error`
  - **Type**: `[out]`
  - **Description**: optional string containing error message if insert fails
  - **Example / Default**: `''`


### Return Value
- **Type**: `boolean`
- **Description**: indicating success/failure

### How it Works
Details about internal logic are inferred from the code. Involves database operations. Uses conditional logic.

### Examples of Usage
```php
update(null, null, null, '');
```

### See Also
[`sql()`](#sql), [`prepare_sql_set()`](#prepare_sql_set)


---

## `set_record_owner`

### Description
@brief Set/update the owner of given record

### Parameters
- **Name**: `$tn`
  - **Type**: `[in]`
  - **Description**: name of table
  - **Example / Default**: `null`

- **Name**: `$pk`
  - **Type**: `[in]`
  - **Description**: primary key value
  - **Example / Default**: `null`

- **Name**: `$user`
  - **Type**: `[in]`
  - **Description**: username to set as owner. If not provided (or false), update dateUpdated only Optional. Default: false.
  - **Example / Default**: `false`


### Return Value
- **Type**: `boolean`
- **Description**: indicating success/failure

### How it Works
Details about internal logic are inferred from the code. Involves database operations. Uses conditional logic.

### Examples of Usage
```php
set_record_owner(null, null, false);
```

### See Also
[`sql()`](#sql), [`prepare_sql_set()`](#prepare_sql_set), [`update()`](#update), [`insert()`](#insert), [`backtick_keys_once()`](#backtick_keys_once)


---

## `app_datetime_format`

### Description
@brief get date/time format string for use in different cases.

### Parameters
- **Name**: `$destination`
  - **Type**: `[in]`
  - **Description**: string, one of these: 'php' (see date function), 'mysql', 'moment' Optional. Default: 'php'.
  - **Example / Default**: `'php'`

- **Name**: `$datetime`
  - **Type**: `[in]`
  - **Description**: string, one of these: 'd' = date, 't' = time, 'dt' = both Optional. Default: 'd'.
  - **Example / Default**: `'d'`


### Return Value
- **Type**: `string`
- **Description**: N/A

### How it Works
Details about internal logic are inferred from the code. Uses conditional logic.

### Examples of Usage
```php
app_datetime_format('php', 'd');
```

### See Also
None.


---

## `test`

### Description
@brief perform a test and return results

### Parameters
- **Name**: `$subject`
  - **Type**: `[in]`
  - **Description**: string used as title of test
  - **Example / Default**: `null`

- **Name**: `$test_param`
  - **Type**: `[in]`
  - **Description**: callable function containing the test to be performed, should return true on success, false or a log string on error
  - **Example / Default**: `null`


### Return Value
- **Type**: `test`
- **Description**: result

### How it Works
Details about internal logic are inferred from the code. Uses conditional logic.

### Examples of Usage
```php
test(null, null);
```

### See Also
None.


---

## `invoke_method`

### Description
@brief invoke a method of an object -- useful to call private/protected methods

### Parameters
- **Name**: `$object`
  - **Type**: `[in]`
  - **Description**: instance of object containing the method
  - **Example / Default**: `null`

- **Name**: `$methodName`
  - **Type**: `[in]`
  - **Description**: string name of method to invoke
  - **Example / Default**: `null`

- **Name**: `$parameters`
  - **Type**: `array`
  - **Description**: array of parameters to pass to the method Optional. Default: [].
  - **Example / Default**: `[]`


### Return Value
- **Type**: `the`
- **Description**: returned value from the invoked method

### How it Works
A relatively short function. Details about internal logic are inferred from the code.

### Examples of Usage
```php
invoke_method(null, null, []);
```

### See Also
None.


---

## `get_property`

### Description
@brief retrieve the value of a property of an object -- useful to retrieve private/protected props

### Parameters
- **Name**: `$object`
  - **Type**: `[in]`
  - **Description**: instance of object containing the method
  - **Example / Default**: `null`

- **Name**: `$propName`
  - **Type**: `[in]`
  - **Description**: string name of property to retrieve
  - **Example / Default**: `null`


### Return Value
- **Type**: `the`
- **Description**: returned value of the given property, or null if property doesn't exist

### How it Works
Details about internal logic are inferred from the code.

### Examples of Usage
```php
get_property(null, null);
```

### See Also
None.


---

## `invoke_static_method`

### Description
@brief invoke a method of a static class -- useful to call private/protected methods

### Parameters
- **Name**: `$class_param`
  - **Type**: `[in]`
  - **Description**: string name of the class containing the method
  - **Example / Default**: `null`

- **Name**: `$methodName`
  - **Type**: `[in]`
  - **Description**: string name of method to invoke
  - **Example / Default**: `null`

- **Name**: `$parameters`
  - **Type**: `array`
  - **Description**: array of parameters to pass to the method Optional. Default: [].
  - **Example / Default**: `[]`


### Return Value
- **Type**: `the`
- **Description**: returned value from the invoked method

### How it Works
A relatively short function. Details about internal logic are inferred from the code.

### Examples of Usage
```php
invoke_static_method(null, null, []);
```

### See Also
None.


---

## `mysql_datetime`

### Description
Function starts with: $app_datetime = trim($app_datetime); ; if($date_format === null) $date_format = app_datetime_format('php', 'd');

### Parameters
- **Name**: `$app_datetime_param`
  - **Type**: `[in]`
  - **Description**: string, a datetime formatted in app-specific format
  - **Example / Default**: `null`

- **Name**: `$date_format`
  - **Type**: `mixed`
  - **Description**: Optional. Default: null.
  - **Example / Default**: `null`

- **Name**: `$time_format`
  - **Type**: `mixed`
  - **Description**: Optional. Default: null.
  - **Example / Default**: `null`


### Return Value
- **Type**: `string,`
- **Description**: mysql-formatted datetime, 'yyyy-mm-dd H:i:s', or empty string on error

### How it Works
Details about internal logic are inferred from the code. Uses conditional logic.

### Examples of Usage
```php
mysql_datetime(null, null, null);
```

### See Also
[`app_datetime_format()`](#app_datetime_format)


---

## `app_datetime`

### Description
Function starts with: $pyear = $myear = substr($mysql_datetime, 0, 4); ; // if date is 0 (0000-00-00) return empty string

### Parameters
- **Name**: `$mysql_datetime_param`
  - **Type**: `[in]`
  - **Description**: string, Mysql-formatted datetime
  - **Example / Default**: `null`

- **Name**: `$datetime_param`
  - **Type**: `[in]`
  - **Description**: string, one of these: 'd' = date, 't' = time, 'dt' = both Optional. Default: 'd'.
  - **Example / Default**: `'d'`


### Return Value
- **Type**: `string,`
- **Description**: app-formatted datetime, or empty string on error

### How it Works
Details about internal logic are inferred from the code. Uses conditional logic.

### Examples of Usage
```php
app_datetime(null, 'd');
```

### See Also
[`app_datetime_format()`](#app_datetime_format)


---

## `to_utf8`

### Description
converts string from app-configured encoding to utf8

### Parameters
- **Name**: `$str`
  - **Type**: `[in]`
  - **Description**: string to convert to utf8
  - **Example / Default**: `null`


### Return Value
- **Type**: `utf8-encoded`
- **Description**: string

### How it Works
A relatively short function. Details about internal logic are inferred from the code. Uses conditional logic.

### Examples of Usage
```php
to_utf8(null);
```

### See Also
None.


---

## `from_utf8`

### Description
converts string from utf8 to app-configured encoding

### Parameters
- **Name**: `$str`
  - **Type**: `[in]`
  - **Description**: string to convert from utf8
  - **Example / Default**: `null`


### Return Value
- **Type**: `string`
- **Description**: utf8-decoded string

### How it Works
A relatively short function. Details about internal logic are inferred from the code. Uses conditional logic.

### Examples of Usage
```php
from_utf8(null);
```

### See Also
None.


---

## `array_trim`

### Description
/* deep trimmer function

### Parameters
- **Name**: `$arr`
  - **Type**: `mixed`
  - **Description**: N/A
  - **Example / Default**: `null`


### Return Value
- **Type**: `mixed`
- **Description**: Returns different values based on conditions.

### How it Works
A relatively short function. Details about internal logic are inferred from the code. Uses conditional logic.

### Examples of Usage
```php
array_trim(null);
```

### See Also
None.


---

## `request_outside_admin_folder`

### Description
Function starts with: return (realpath(__DIR__) != realpath(dirname($_SERVER['SCRIPT_FILENAME'])));

### Parameters
This function takes no parameters.

### Return Value
- **Type**: `mixed`
- **Description**: Returns a literal value: (realpath(__DIR__) != realpath(dirname($_SERVER['SCRIPT_FILENAME'])))

### How it Works
A relatively short function. Details about internal logic are inferred from the code.

### Examples of Usage
```php
request_outside_admin_folder();
```

### See Also
None.


---

## `get_parent_tables`

### Description
Function starts with: /* parents array: ; * 'child table' => [parents], ...

### Parameters
- **Name**: `$table`
  - **Type**: `mixed`
  - **Description**: N/A
  - **Example / Default**: `null`


### Return Value
- **Type**: `mixed`
- **Description**: Returns a literal value: isset($parents[$table]) ? $parents[$table] : []

### How it Works
Details about internal logic are inferred from the code.

### Examples of Usage
```php
get_parent_tables(null);
```

### See Also
None.


---

## `backtick_keys_once`

### Description
Function starts with: return array_combine( ; /* add backticks to keys */

### Parameters
- **Name**: `$arr_data`
  - **Type**: `mixed`
  - **Description**: N/A
  - **Example / Default**: `null`


### Return Value
- **Type**: `string`
- **Description**: Returns a literal value: '`' . trim($e, '`') . '`'

### How it Works
Details about internal logic are inferred from the code.

### Examples of Usage
```php
backtick_keys_once(null);
```

### See Also
None.


---

## `calculated_fields`

### Description
Function starts with: /* ; * calculated fields configuration array, $calc:

### Parameters
This function takes no parameters.

### Return Value
- **Type**: `void`
- **Description**: This function does not return a value.

### How it Works
Details about internal logic are inferred from the code.

### Examples of Usage
```php
calculated_fields();
```

### See Also
None.


---

## `update_calc_fields`

### Description
Function starts with: if($mi === false) $mi = getMemberInfo(); ; $pk = getPKFieldName($table);

### Parameters
- **Name**: `$table`
  - **Type**: `mixed`
  - **Description**: N/A
  - **Example / Default**: `null`

- **Name**: `$id`
  - **Type**: `mixed`
  - **Description**: N/A
  - **Example / Default**: `null`

- **Name**: `$formulas`
  - **Type**: `mixed`
  - **Description**: N/A
  - **Example / Default**: `null`

- **Name**: `$mi`
  - **Type**: `mixed`
  - **Description**: Optional. Default: false.
  - **Example / Default**: `false`


### Return Value
- **Type**: `mixed`
- **Description**: Returns the result of: $caluclations_made

### How it Works
Details about internal logic are inferred from the code. Involves database operations. Contains loop(s) for iteration. Uses conditional logic.

### Examples of Usage
```php
update_calc_fields(null, null, null, false);
```

### See Also
[`sql()`](#sql), [`sqlValue()`](#sqlvalue), [`getPKFieldName()`](#getpkfieldname), [`makeSafe()`](#makesafe)


---

## `existing_value`

### Description
Function starts with: /* cache results in records[tablename][id] */ ; static $record = [];

### Parameters
- **Name**: `$tn`
  - **Type**: `mixed`
  - **Description**: N/A
  - **Example / Default**: `null`

- **Name**: `$fn`
  - **Type**: `mixed`
  - **Description**: N/A
  - **Example / Default**: `null`

- **Name**: `$id`
  - **Type**: `mixed`
  - **Description**: N/A
  - **Example / Default**: `null`

- **Name**: `$cache`
  - **Type**: `mixed`
  - **Description**: Optional. Default: true.
  - **Example / Default**: `true`


### Return Value
- **Type**: `mixed`
- **Description**: Returns different values based on conditions.

### How it Works
A relatively short function. Details about internal logic are inferred from the code. Uses conditional logic.

### Examples of Usage
```php
existing_value(null, null, null, true);
```

### See Also
[`getRecord()`](#getrecord)


---

## `checkAppRequirements`

### Description
Function starts with: global $Translation; ; $reqErrors = [];

### Parameters
This function takes no parameters.

### Return Value
- **Type**: `void`
- **Description**: This function does not return a value.

### How it Works
Details about internal logic are inferred from the code. Uses conditional logic.

### Examples of Usage
```php
checkAppRequirements();
```

### See Also
None.


---

## `getRecord`

### Description
Function starts with: // get PK fieldname ; if(!$pk = getPKFieldName($table)) return false;

### Parameters
- **Name**: `$table`
  - **Type**: `mixed`
  - **Description**: N/A
  - **Example / Default**: `null`

- **Name**: `$id`
  - **Type**: `mixed`
  - **Description**: N/A
  - **Example / Default**: `null`


### Return Value
- **Type**: `mixed`
- **Description**: Returns different values based on conditions.

### How it Works
A relatively short function. Details about internal logic are inferred from the code. Involves database operations. Uses conditional logic.

### Examples of Usage
```php
getRecord(null, null);
```

### See Also
[`sql()`](#sql), [`getPKFieldName()`](#getpkfieldname), [`makeSafe()`](#makesafe)


---

## `guessMySQLDateTime`

### Description
Function starts with: // extract date and time, assuming a space separator ; list($date, $time, $ampm) = preg_split('/\s+/', trim($dt));

### Parameters
- **Name**: `$dt`
  - **Type**: `mixed`
  - **Description**: N/A
  - **Example / Default**: `null`


### Return Value
- **Type**: `mixed`
- **Description**: Returns different values based on conditions.

### How it Works
Details about internal logic are inferred from the code. Uses conditional logic.

### Examples of Usage
```php
guessMySQLDateTime(null);
```

### See Also
[`mysql_datetime()`](#mysql_datetime), [`time12()`](#time12), [`time24()`](#time24)


---

## `lookupQuery`

### Description
Function starts with: /* ; This is the query accessible from the 'Advanced' window under the 'Lookup field' tab in AppGini.

### Parameters
- **Name**: `$tn`
  - **Type**: `mixed`
  - **Description**: N/A
  - **Example / Default**: `null`

- **Name**: `$lookupField`
  - **Type**: `mixed`
  - **Description**: N/A
  - **Example / Default**: `null`


### Return Value
- **Type**: `mixed`
- **Description**: Returns the result of: $lookupQuery[$tn][$lookupField]

### How it Works
Details about internal logic are inferred from the code.

### Examples of Usage
```php
lookupQuery(null, null);
```

### See Also
None.


---

## `pkGivenLookupText`

### Description
Function starts with: static $cache = []; ; if(isset($cache[$tn][$lookupField][$val])) return $cache[$tn][$lookupField][$val];

### Parameters
- **Name**: `$val`
  - **Type**: `mixed`
  - **Description**: N/A
  - **Example / Default**: `null`

- **Name**: `$tn`
  - **Type**: `mixed`
  - **Description**: N/A
  - **Example / Default**: `null`

- **Name**: `$lookupField_param`
  - **Type**: `mixed`
  - **Description**: N/A
  - **Example / Default**: `null`

- **Name**: `$falseIfNotFound`
  - **Type**: `mixed`
  - **Description**: Optional. Default: false.
  - **Example / Default**: `false`


### Return Value
- **Type**: `mixed`
- **Description**: Returns different values based on conditions.

### How it Works
Details about internal logic are inferred from the code. Involves database operations. Uses conditional logic.

### Examples of Usage
```php
pkGivenLookupText(null, null, null, false);
```

### See Also
[`sqlValue()`](#sqlvalue), [`lookupQuery()`](#lookupquery), [`makeSafe()`](#makesafe)


---

## `userCanImport`

### Description
Function starts with: $mi = getMemberInfo(); ; $safeUser = makeSafe($mi['username']);

### Parameters
This function takes no parameters.

### Return Value
- **Type**: `mixed`
- **Description**: Returns different values based on conditions.

### How it Works
Details about internal logic are inferred from the code. Involves database operations. Uses conditional logic.

### Examples of Usage
```php
userCanImport();
```

### See Also
[`sqlValue()`](#sqlvalue), [`makeSafe()`](#makesafe)


---

## `parseTemplate`

### Description
Function starts with: if(trim($template) == '') return $template; ; global $Translation;

### Parameters
- **Name**: `$template`
  - **Type**: `mixed`
  - **Description**: N/A
  - **Example / Default**: `null`


### Return Value
- **Type**: `mixed`
- **Description**: Returns different values based on conditions.

### How it Works
Details about internal logic are inferred from the code. Contains loop(s) for iteration. Uses conditional logic.

### Examples of Usage
```php
parseTemplate(null);
```

### See Also
[`getUploadDir()`](#getuploaddir)


---

## `getUploadDir`

### Description
Function starts with: if($dir == '') $dir = config('adminConfig')['baseUploadPath']; ; return rtrim($dir, '\\/') . DIRECTORY_SEPARATOR;

### Parameters
- **Name**: `$dir_param`
  - **Type**: `mixed`
  - **Description**: Optional. Default: ''.
  - **Example / Default**: `''`


### Return Value
- **Type**: `mixed`
- **Description**: Returns a literal value: rtrim($dir, '\\/') . DIRECTORY_SEPARATOR

### How it Works
A relatively short function. Details about internal logic are inferred from the code. Uses conditional logic.

### Examples of Usage
```php
getUploadDir('');
```

### See Also
None.


---

## `bgStyleToClass`

### Description
Function starts with: return preg_replace( ; '/ style="background-color: rgb\((\d+), (\d+), (\d+)\);"/',

### Parameters
- **Name**: `$html`
  - **Type**: `mixed`
  - **Description**: N/A
  - **Example / Default**: `null`


### Return Value
- **Type**: `void`
- **Description**: This function does not return a value.

### How it Works
A relatively short function. Details about internal logic are inferred from the code.

### Examples of Usage
```php
bgStyleToClass(null);
```

### See Also
None.


---

## `assocArrFilter`

### Description
Function starts with: if(!is_array($arr) || !count($arr)) return $arr; ; if(!is_callable($func)) return false;

### Parameters
- **Name**: `$arr`
  - **Type**: `mixed`
  - **Description**: N/A
  - **Example / Default**: `null`

- **Name**: `$func`
  - **Type**: `mixed`
  - **Description**: N/A
  - **Example / Default**: `null`


### Return Value
- **Type**: `mixed`
- **Description**: Returns different values based on conditions.

### How it Works
Details about internal logic are inferred from the code. Uses conditional logic.

### Examples of Usage
```php
assocArrFilter(null, null);
```

### See Also
None.


---

## `setUserData`

### Description
Function starts with: $data = []; ; $user = makeSafe(getMemberInfo()['username']);

### Parameters
- **Name**: `$key`
  - **Type**: `mixed`
  - **Description**: N/A
  - **Example / Default**: `null`

- **Name**: `$value`
  - **Type**: `mixed`
  - **Description**: Optional. Default: null.
  - **Example / Default**: `null`


### Return Value
- **Type**: `bool`
- **Description**: Returns a literal value: false

### How it Works
Details about internal logic are inferred from the code. Involves database operations. Uses conditional logic.

### Examples of Usage
```php
setUserData(null, null);
```

### See Also
[`sqlValue()`](#sqlvalue), [`update()`](#update), [`makeSafe()`](#makesafe)


---

## `getUserData`

### Description
Function starts with: $user = makeSafe(getMemberInfo()['username']); ; if(!$user) return null;

### Parameters
- **Name**: `$key`
  - **Type**: `mixed`
  - **Description**: N/A
  - **Example / Default**: `null`


### Return Value
- **Type**: `mixed`
- **Description**: Returns different values based on conditions.

### How it Works
Details about internal logic are inferred from the code. Involves database operations. Uses conditional logic.

### Examples of Usage
```php
getUserData(null);
```

### See Also
[`sqlValue()`](#sqlvalue), [`makeSafe()`](#makesafe)


---

## `breakpoint`

### Description
Function starts with: if(!DEBUG_MODE) return; ; if(strpos($_SERVER['PHP_SELF'], 'ajax_check_login.php') !== false) return;

### Parameters
- **Name**: `$file`
  - **Type**: `mixed`
  - **Description**: N/A
  - **Example / Default**: `null`

- **Name**: `$line`
  - **Type**: `mixed`
  - **Description**: N/A
  - **Example / Default**: `null`

- **Name**: `$msg`
  - **Type**: `mixed`
  - **Description**: N/A
  - **Example / Default**: `null`


### Return Value
- **Type**: `void`
- **Description**: This function does not return a value.

### How it Works
Details about internal logic are inferred from the code. Uses conditional logic.

### Examples of Usage
```php
breakpoint(null, null, null);
```

### See Also
None.


---

## `denyAccess`

### Description
Function starts with: @header($_SERVER['SERVER_PROTOCOL'] . ' 403 Access Denied'); ; die($msg);

### Parameters
- **Name**: `$msg`
  - **Type**: `mixed`
  - **Description**: Optional. Default: null.
  - **Example / Default**: `null`


### Return Value
- **Type**: `void`
- **Description**: This function does not return a value.

### How it Works
A relatively short function. Details about internal logic are inferred from the code.

### Examples of Usage
```php
denyAccess(null);
```

### See Also
None.


---

## `is_xhr`

### Description
Function starts with: return (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');

### Parameters
This function takes no parameters.

### Return Value
- **Type**: `mixed`
- **Description**: Returns a literal value: (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')

### How it Works
A relatively short function. Details about internal logic are inferred from the code.

### Examples of Usage
```php
is_xhr();
```

### See Also
None.


---

## `json_response`

### Description
send a json response to the client and terminate

### Parameters
- **Name**: `$dataOrMsg`
  - **Type**: `[in]`
  - **Description**: mixed, either an array of data to send, or a string error message
  - **Example / Default**: `null`

- **Name**: `$isError`
  - **Type**: `[in]`
  - **Description**: bool, true if $dataOrMsg is an error message, false if it's data Optional. Default: false.
  - **Example / Default**: `false`

- **Name**: `$errorStatusCode`
  - **Type**: `[in]`
  - **Description**: int, HTTP status code to send Optional. Default: 400.
  - **Example / Default**: `400`


### Return Value
- **Type**: `void`
- **Description**: This function does not return a value.

### How it Works
Details about internal logic are inferred from the code. Uses conditional logic.

### Examples of Usage
```php
json_response(null, false, 400);
```

### See Also
None.


---

## `httpRequest`

### Description
Check if a string is alphanumeric.
We're defining it here in case it's not defined by some PHP installations.
It's reuired by PHPMailer.

Perform an HTTP request and return the response, including headers and body, with support to cookies

### Parameters
- **Name**: `$url`
  - **Type**: `string`
  - **Description**: URL to request
  - **Example / Default**: `''`

- **Name**: `$payload`
  - **Type**: `array`
  - **Description**: payload to send with the request Optional. Default: [].
  - **Example / Default**: `[]`

- **Name**: `$headers`
  - **Type**: `array`
  - **Description**: headers to send with the request, in the format ['header' => 'value'] Optional. Default: [].
  - **Example / Default**: `[]`

- **Name**: `$type`
  - **Type**: `string`
  - **Description**: request type, either 'GET' or 'POST' Optional. Default: 'GET'.
  - **Example / Default**: `'GET'`

- **Name**: `$cookieJar`
  - **Type**: `string`
  - **Description**: path to a file to read/store cookies in Optional. Default: null.
  - **Example / Default**: `null`


### Return Value
- **Type**: `array`
- **Description**: response, including `'headers'` and `'body'`, or error info if request failed

### How it Works
Details about internal logic are inferred from the code. Contains loop(s) for iteration. Uses conditional logic.

### Examples of Usage
```php
httpRequest('', [], [], 'GET', null);
```

### See Also
None.


---

## `getRecordOwner`

### Description
Retrieve owner username of the record with the given primary key value

### Parameters
- **Name**: `$tn`
  - **Type**: `string`
  - **Description**: table name
  - **Example / Default**: `''`

- **Name**: `$pkValue`
  - **Type**: `string`
  - **Description**: primary key value
  - **Example / Default**: `''`


### Return Value
- **Type**: `string|null`
- **Description**: username of the record owner, or null if not found

### How it Works
A relatively short function. Details about internal logic are inferred from the code. Involves database operations. Uses conditional logic.

### Examples of Usage
```php
getRecordOwner('', '');
```

### See Also
[`sqlValue()`](#sqlvalue), [`makeSafe()`](#makesafe)


---

## `tableRecordOwner`

### Description
Retrieve lookup field name that determines record owner of the given table

### Parameters
- **Name**: `$tn`
  - **Type**: `string`
  - **Description**: table name
  - **Example / Default**: `''`


### Return Value
- **Type**: `string|null`
- **Description**: lookup field name, or null if default (record owner is user that creates the record)

### How it Works
A relatively short function. Details about internal logic are inferred from the code.

### Examples of Usage
```php
tableRecordOwner('');
```

### See Also
None.


---

## `notNullFields`

### Description
Retrieve not-nullable fields of the given table

### Parameters
- **Name**: `$tn`
  - **Type**: `string`
  - **Description**: table name
  - **Example / Default**: `''`


### Return Value
- **Type**: `array`
- **Description**: list of not-nullable fields

### How it Works
Details about internal logic are inferred from the code. Uses conditional logic.

### Examples of Usage
```php
notNullFields('');
```

### See Also
[`get_table_fields()`](#get_table_fields)
