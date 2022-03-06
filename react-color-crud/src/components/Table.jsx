import React from "react";
import Color from "./Color";

function Table({colors, setColors}) {

  return (
    <table>
        <thead>                  
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Hex Value</th>
            <th>Status</th>
            <th>Created At</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
            {colors.map(
              oneColor => 
                <Color 
                  key = {oneColor.id} 
                  color = {oneColor} 
                  colors = {colors} 
                  setColors = {setColors}
                  />
            )}
        </tbody>
    </table>
  );
}

export default Table;
