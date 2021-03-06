const tabulatorUTCToLocal = function(value, data, type, params, component){
    //value - original value of the cell
    //data - the data for the row
    //type - the type of mutation occurring  (data|edit)
    //params - the mutatorParams object from the column definition
    //component - when the "type" argument is "edit", this contains the cell component for the edited cell, otherwise it is the column component for the column
    return moment.utc(value).local().format("YYYY-MM-DD HH:mm:ss"); //return the new value for the cell data.
}
