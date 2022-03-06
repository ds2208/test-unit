import React, {useState} from "react";
import Action from "./Actions";

function Color({color}) {

  return (
    <tr>
        <td>{color.id ? <p>{color.id}</p> : "#"}</td>
        <td>{color.name ? <p>{color.name}</p> : ""}</td>
        <td>{color.hex_value ? <p>{color.hex_value}</p> : "N/A"}</td>
        <td>{color.status == 1 ? <p>Active</p> : <p>Disabled</p>}</td>
        <td>{color.created_at ? <p>{color.created_at}</p> : "N/A"}</td>
        <td>{<Action actionColor = {color}/>}</td>
    </tr>
  );
}

export default Color;