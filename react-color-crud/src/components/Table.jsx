import React, {useState} from "react";
import Color from "./Color";
import "../style/app.css";

function Table({colors}) {

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
            {colors.map(oneColor => <Color key = {oneColor.id} color = {oneColor}/>)}
        </tbody>
    </table>
  );
}

export default Table;
