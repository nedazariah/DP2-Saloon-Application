document.getElementById("nform").onsubmit = function(){
    
    var hasEmpty = false, message = "";
    var itemName = document.getElementById("itemName").value;
    var itemDesc = document.getElementById("itemDesc").value;
    var itemType = document.getElementById("itemType").value;
    var itemBPrice = document.getElementById("itemBPrice").value;
    var itemSPrice = document.getElementById("itemSPrice").value;
    var itemQuantity = document.getElementById("itemQuantity").value;
    
    if(itemName == "" || itemName == null)
    {
        alert("Item name cannot be empty");
        return false;
    }
    else
    {
        if(itemDesc == "" || itemDesc == null)
        {
            hasEmpty = true;
            message += "Item description is not filled. \n";
        }

        if(itemType == "" || itemType == null)
        {
            hasEmpty = true;
            message += "Item type is not filled. \n";
        }

        if(itemBPrice == "" || itemBPrice == null || itemBPrice == 0)
        {
            hasEmpty = true;
            message += "Item buying price is set at 0 or not filled. \n";
        }

        if(itemSPrice == "" || itemSPrice == null || itemSPrice == 0)
        {
            hasEmpty = true;
            message += "Item selling price is set at 0 or not filled. \n";
        }

        if(itemQuantity == "" || itemQuantity == null || itemQuantity == 0)
        {
            hasEmpty = true;
            message += "Stock quantity is set at 0 or not filled. \n";
        }

        if(hasEmpty)
        {
            return confirm("Are you sure with the fields?\n" + message);
        }
        else
        {
            return confirm("Confirm form submission?");
        }
    }
}
