# wp-tedapi-plugin

We are using a part of code from TEDx Local Portal in France (https://github.com/TEDxOrganizers/localportal)

#### Google Spreadsheets

* Go to [Google Drive](https://drive.google.com/) and create a simple and clean google spreadsheet.
* Go in [```googlescript/Code.gs```](https://raw.github.com/joshfire/tedxenfrance/master/googlescript/Code.gs).
* In your google spreadsheet, go to **Tools > Script editor...** in the topbar menu.
* Create a spreadsheet script and replace all the code by the copied code before.
  * To edit the specific country in what you want the TEDx events, just change the code of the country by yours.
    (A list of the countries ID are available in [```googlescript/id_countries.txt```](https://raw.github.com/joshfire/tedxenfrance/master/googlescript/id_countries.txt))
    ```javascript

      function run() {
        var COUNTRY_ID = 162; //FRANCE = 162
        ...  
      }
    ```
  * **[Required]** Edit the apikey to get data from TED API in the following line.
    (if you don't have an apikey, [contact TED](http://developer.ted.com/contact_us) to have one.)
    ```javascript

      ...
      var response = UrlFetchApp.fetch("https://api.ted.com/v1/tedx_event_locations.json?api-key=XXXXXXXXXXXXXXXXXXXXXXX&country_id="+COUNTRY_ID+"&order=starts_at:desc&limit=110");
      ...
    ```
* Save the code and close it.
* **_Refresh_** or **_close and re-open_** the google spreadsheet you have created.
* You are now able to see a new menu on the topbar menu, called **Update Data**.
* Click on **Update Data > Update TEDx Data**.
* Wait and see ! All the required sheets have been created and all the datas about TEDx events are fill.

- TEDx Events
  
  This sheet represent all the datas about TEDx events present on the "Home" page and "Conferences" page.
  Different columns are displayed with in each header a little note helping you if you want to modify contents.

- TEDx Blacklist Twitter

  It represent the tweets that you want to blacklist/not display on your web application.
  Simply put the URL of the tweet inside the cell and "VOILA!", we make the job automatically.

- TEDx About
  
  It represent the content displayed in the "About TEDx" page. Each line of the spreadsheet represent a paragraph.
  Make your own custom "About" page adding images and their position (left or right).

- Google Spreadsheet URL
  
  After all this steps, your spreadsheet is ready to run with your web application but we miss only one data: the url of the spreadsheet.
  - Go to **File > Publish to the web...**
  - Copy the link of the published spreadsheet.
