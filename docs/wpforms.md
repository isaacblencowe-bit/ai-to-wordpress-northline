# Recreate the native demonstration form

No validated standalone WPForms export exists in the deliverables, so none is invented here. Contact's Elementor export contains the native widget and styling only. Install WPForms Lite from WordPress.org, create a blank form named “Northline — Project Enquiry (Demo)”, and add:

| Field | Type | Required | Options |
|---|---|---|---|
| Full name | Name, Simple format | Yes | Large |
| Email address | Email | Yes | Large |
| Phone number | Single Line Text | No | Large; include area code |
| Project type | Dropdown | Yes | Custom home; Renovation; Extension; Project management; Still exploring |
| Project suburb | Single Line Text | Yes | Placeholder: e.g. Brighton |
| Preferred timing | Dropdown | No | Still exploring; Within 6 months; 6–12 months; More than 12 months |
| Tell us about your project | Paragraph Text | Yes | Description: For this demonstration, enter test information only. |

Use submit label “Submit demo enquiry”; enable built-in spam protection and AJAX submission where supported. Disable email notifications and do not opt into cloud entry backup for this demonstration. Use message confirmation:

> Demo complete. No enquiry email has been sent. This form is ready for a real notification recipient and delivery setup before launch.

Save the form. In the Contact Elementor WPForms widget, select the newly created local form. Verify required-field and email validation and the demo confirmation with synthetic data. No delivery integration is included. Phone uses free text, not the paid Phone field's international validation. Exact admin labels can differ by plugin version.
