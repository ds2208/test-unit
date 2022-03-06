import React from "react";
import { changeStatus, deleteColor } from "../colors-service";

function Action({actionColor, colorStatus, setColorStatus, colors, setColors}) {

  return (
    <div className="actions">
        <button onClick={() => {
              changeStatus(actionColor.id).then(result => {
                if(result.data.status === "ok") {
                  let colorIndex = colors.findIndex((color => color.id === actionColor.id));
                  colors[colorIndex].status = !colors[colorIndex].status;
                  setColorStatus(!colorStatus);
                }
              }).catch(error => {
                console.log(error);
              });
          }}>{actionColor.status ? 'Deactivate' : 'Activate'}</button>
        <button onClick={() => {
              deleteColor(actionColor.id).then(result => {
                if(result.data.status === "ok") {
                    setColors(colors.filter(function(color){ 
                      return color.id !== actionColor.id;
                    }));
                }
              }).catch(error => {
                console.log(error);
              });
          }}>Delete</button>
    </div>
  );
}

export default Action;