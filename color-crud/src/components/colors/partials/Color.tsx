import { IoCloseCircleOutline, IoColorWandOutline, IoGitCompareOutline } from "react-icons/io5";

function Color(props: ColorProps) {

  return (
    <tr>
      <td>{props.color.id ?? "#"}</td>
      <td>{props.color.name ?? ""}</td>
      <td>{props.color.hex_value ?? "N/A"}</td>
      <td>{props.color.status ? "Active" : "Disabled"}</td>
      <td>
        <a className='btn btn-outline-warning m-3' href="#">
          <IoColorWandOutline></IoColorWandOutline>
        </a>
        <a className='btn btn-outline-info m-3' href="#">
          <IoGitCompareOutline></IoGitCompareOutline>
        </a>
        <a className='btn btn-outline-danger m-3' href="#">
          <IoCloseCircleOutline></IoCloseCircleOutline>
        </a>
      </td>
    </tr>
    // <td>{<Action actionColor = {color} colorStatus = {colorStatus} setColorStatus = {setColorStatus} colors = {colors} setColors = {setColors}/>}</td>
  );
}

type ColorProps = {
  color: {
      id: number,
      name: string,
      hex_value: string,
      status: boolean
  }
};

export default Color;