# NotifyForms Plugin

Integrates [Sixgweb.Forms](https://www.octobercms.com/plugins/sixgweb-forms) with [RainLab.Notify](https://octobercms.com/plugin/rainlab-notify) plugin, providing notifications of new entries.

### Settings Tab

#### Is Enabled
Enable or disable the form

#### Submission Redirect URL
Page/URL to redirect to, after successful entry.  Leave blank to show Confirmation Message.

#### Notifying
Save entries to the database.

#### Purge Entries
Purge entries saved to the database, after a specified number of days.

#### Days to Keep Entries
Number of days to keep entries, if Purge Entries is enabled.

#### Throttle Entries
Whether visitors should have to wait before submitting the form again.

#### Throttle Timeout
Number of seconds the visitor must wait, if throttling is enabled.

#### Throttle Threshold
Number of submissions allowed before the throttle timeout is enforced (default 1).

### Fields Tab
Displays the Attributize field editor, conditioned to the current form

Fields created under the Fields Tab will automatically have a condition created for the current form.

### Conditions Tab
Displays the form Conditions editor, allowing conditions required to view the form.