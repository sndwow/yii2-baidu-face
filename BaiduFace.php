<?php
/**
 * author: WCY
 * date: 2020/02/10 12:20 AM
 * version: 1.0
 */


namespace sndwow;

use AipFace;
use yii\base\Component;

class BaiduFace extends Component
{
    /**
     * 百度应用appid
     *
     * @var string
     */
    public $appid = '';
    
    /**
     * 百度应用key
     *
     * @var string
     */
    public $apiKey = '';
    
    /**
     * 百度应用秘钥
     *
     * @var string
     */
    public $secretKey = '';
    
    /* @var AipFace $face */
    private $face = null;
    
    public function __construct($config = [])
    {
        parent::__construct($config);
        $this->face = new  AipFace($this->appid, $this->apiKey, $this->secretKey);
    }
    
    /**
     * 获取原实例
     *
     * @return AipFace
     */
    public function getInstance()
    {
        return $this->face;
    }
    
    /**
     * 人脸检测接口
     *
     * @param string $image - 图片信息(**总数据大小应小于10M**)，图片上传方式根据image_type来判断
     * @param string $imageType - 图片类型 **BASE64**:图片的base64值，base64编码后的图片数据，需urlencode，编码后的图片大小不超过2M；**URL**:图片的 URL地址( 可能由于网络等原因导致下载图片时间过长)**；FACE_TOKEN**: 人脸图片的唯一标识，调用人脸检测接口时，会为每个人脸图片赋予一个唯一的FACE_TOKEN，同一张图片多次检测得到的FACE_TOKEN是同一个
     * @param array $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     *   face_field 包括**age,beauty,expression,face_shape,gender,glasses,landmark,landmark72，landmark150，race,quality,eye_status,emotion,face_type信息**  <br> 逗号分隔. 默认只返回face_token、人脸框、概率和旋转角度
     *   max_face_num 最多处理人脸的数目，默认值为1，仅检测图片中面积最大的那个人脸；**最大值10**，检测图片中面积最大的几张人脸。
     *   face_type 人脸的类型 **LIVE**表示生活照：通常为手机、相机拍摄的人像图片、或从网络获取的人像图片等**IDCARD**表示身份证芯片照：二代身份证内置芯片中的人像照片 **WATERMARK**表示带水印证件照：一般为带水印的小图，如公安网小图 **CERT**表示证件照片：如拍摄的身份证、工卡、护照、学生证等证件图片 默认**LIVE**
     *   liveness_control 活体检测控制  **NONE**: 不进行控制 **LOW**:较低的活体要求(高通过率 低攻击拒绝率) **NORMAL**: 一般的活体要求(平衡的攻击拒绝率, 通过率) **HIGH**: 较高的活体要求(高攻击拒绝率 低通过率) **默认NONE**
     * @return array
     */
    public function detect($image, $imageType, $options = [])
    {
        return $this->face->detect($image, $imageType, $options);
    }
    
    /**
     * 人脸搜索接口
     *
     * @param string $image - 图片信息(**总数据大小应小于10M**)，图片上传方式根据image_type来判断
     * @param string $imageType - 图片类型 **BASE64**:图片的base64值，base64编码后的图片数据，需urlencode，编码后的图片大小不超过2M；**URL**:图片的 URL地址( 可能由于网络等原因导致下载图片时间过长)**；FACE_TOKEN**: 人脸图片的唯一标识，调用人脸检测接口时，会为每个人脸图片赋予一个唯一的FACE_TOKEN，同一张图片多次检测得到的FACE_TOKEN是同一个
     * @param string $groupIdList - 从指定的group中进行查找 用逗号分隔，**上限20个**
     * @param array $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     *   max_face_num 最多处理人脸的数目<br>**默认值为1(仅检测图片中面积最大的那个人脸)** **最大值10**
     *   match_threshold 匹配阈值（设置阈值后，score低于此阈值的用户信息将不会返回） 最大100 最小0 默认80 <br>**此阈值设置得越高，检索速度将会越快，推荐使用默认阈值`80`**
     *   quality_control 图片质量控制  **NONE**: 不进行控制 **LOW**:较低的质量要求 **NORMAL**: 一般的质量要求 **HIGH**: 较高的质量要求 **默认 NONE**
     *   liveness_control 活体检测控制  **NONE**: 不进行控制 **LOW**:较低的活体要求(高通过率 低攻击拒绝率) **NORMAL**: 一般的活体要求(平衡的攻击拒绝率, 通过率) **HIGH**: 较高的活体要求(高攻击拒绝率 低通过率) **默认NONE**
     *   user_id 当需要对特定用户进行比对时，指定user_id进行比对。即人脸认证功能。
     *   max_user_num 查找后返回的用户数量。返回相似度最高的几个用户，默认为1，最多返回50个。
     * @return array
     */
    public function search($image, $imageType, $groupIdList, $options = [])
    {
        return $this->face->search($image, $imageType, $groupIdList, $options);
    }
    
    /**
     * 人脸搜索 M:N 识别接口
     *
     * @param string $image - 图片信息(**总数据大小应小于10M**)，图片上传方式根据image_type来判断
     * @param string $imageType - 图片类型 **BASE64**:图片的base64值，base64编码后的图片数据，需urlencode，编码后的图片大小不超过2M；**URL**:图片的 URL地址( 可能由于网络等原因导致下载图片时间过长)**；FACE_TOKEN**: 人脸图片的唯一标识，调用人脸检测接口时，会为每个人脸图片赋予一个唯一的FACE_TOKEN，同一张图片多次检测得到的FACE_TOKEN是同一个
     * @param string $groupIdList - 从指定的group中进行查找 用逗号分隔，**上限20个**
     * @param array $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     *   max_face_num 最多处理人脸的数目<br>**默认值为1(仅检测图片中面积最大的那个人脸)** **最大值10**
     *   match_threshold 匹配阈值（设置阈值后，score低于此阈值的用户信息将不会返回） 最大100 最小0 默认80 <br>**此阈值设置得越高，检索速度将会越快，推荐使用默认阈值`80`**
     *   quality_control 图片质量控制  **NONE**: 不进行控制 **LOW**:较低的质量要求 **NORMAL**: 一般的质量要求 **HIGH**: 较高的质量要求 **默认 NONE**
     *   liveness_control 活体检测控制  **NONE**: 不进行控制 **LOW**:较低的活体要求(高通过率 低攻击拒绝率) **NORMAL**: 一般的活体要求(平衡的攻击拒绝率, 通过率) **HIGH**: 较高的活体要求(高攻击拒绝率 低通过率) **默认NONE**
     *   max_user_num 查找后返回的用户数量。返回相似度最高的几个用户，默认为1，最多返回50个。
     * @return array
     */
    public function multiSearch($image, $imageType, $groupIdList, $options = [])
    {
        return $this->face->multiSearch($image, $imageType, $groupIdList, $options);
    }
    
    /**
     * 人脸注册接口
     *
     * @param string $image - 图片信息(总数据大小应小于10M)，图片上传方式根据image_type来判断。注：组内每个uid下的人脸图片数目上限为20张
     * @param string $imageType - 图片类型 **BASE64**:图片的base64值，base64编码后的图片数据，需urlencode，编码后的图片大小不超过2M；**URL**:图片的 URL地址( 可能由于网络等原因导致下载图片时间过长)**；FACE_TOKEN**: 人脸图片的唯一标识，调用人脸检测接口时，会为每个人脸图片赋予一个唯一的FACE_TOKEN，同一张图片多次检测得到的FACE_TOKEN是同一个
     * @param string $groupId - 用户组id（由数字、字母、下划线组成），长度限制128B
     * @param string $userId - 用户id（由数字、字母、下划线组成），长度限制128B
     * @param array $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     *   user_info 用户资料，长度限制256B
     *   quality_control 图片质量控制  **NONE**: 不进行控制 **LOW**:较低的质量要求 **NORMAL**: 一般的质量要求 **HIGH**: 较高的质量要求 **默认 NONE**
     *   liveness_control 活体检测控制  **NONE**: 不进行控制 **LOW**:较低的活体要求(高通过率 低攻击拒绝率) **NORMAL**: 一般的活体要求(平衡的攻击拒绝率, 通过率) **HIGH**: 较高的活体要求(高攻击拒绝率 低通过率) **默认NONE**
     *   action_type 操作方式  APPEND: 当user_id在库中已经存在时，对此user_id重复注册时，新注册的图片默认会追加到该user_id下,REPLACE : 当对此user_id重复注册时,则会用新图替换库中该user_id下所有图片,默认使用APPEND
     * @return array
     */
    public function addUser($image, $imageType, $groupId, $userId, $options = [])
    {
        return $this->face->addUser($image, $imageType, $groupId, $userId, $options);
    }
    
    /**
     * 人脸更新接口
     *
     * @param string $image - 图片信息(**总数据大小应小于10M**)，图片上传方式根据image_type来判断
     * @param string $imageType - 图片类型 **BASE64**:图片的base64值，base64编码后的图片数据，需urlencode，编码后的图片大小不超过2M；**URL**:图片的 URL地址( 可能由于网络等原因导致下载图片时间过长)**；FACE_TOKEN**: 人脸图片的唯一标识，调用人脸检测接口时，会为每个人脸图片赋予一个唯一的FACE_TOKEN，同一张图片多次检测得到的FACE_TOKEN是同一个
     * @param string $groupId - 更新指定groupid下uid对应的信息
     * @param string $userId - 用户id（由数字、字母、下划线组成），长度限制128B
     * @param array $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     *   user_info 用户资料，长度限制256B
     *   quality_control 图片质量控制  **NONE**: 不进行控制 **LOW**:较低的质量要求 **NORMAL**: 一般的质量要求 **HIGH**: 较高的质量要求 **默认 NONE**
     *   liveness_control 活体检测控制  **NONE**: 不进行控制 **LOW**:较低的活体要求(高通过率 低攻击拒绝率) **NORMAL**: 一般的活体要求(平衡的攻击拒绝率, 通过率) **HIGH**: 较高的活体要求(高攻击拒绝率 低通过率) **默认NONE**
     *   action_type 操作方式  APPEND: 当user_id在库中已经存在时，对此user_id重复注册时，新注册的图片默认会追加到该user_id下,REPLACE : 当对此user_id重复注册时,则会用新图替换库中该user_id下所有图片,默认使用APPEND
     * @return array
     */
    public function updateUser($image, $imageType, $groupId, $userId, $options = [])
    {
        return $this->face->updateUser($image, $imageType, $groupId, $userId, $options);
    }
    
    /**
     * 人脸删除接口
     *
     * @param string $userId - 用户id（由数字、字母、下划线组成），长度限制128B
     * @param string $groupId - 用户组id（由数字、字母、下划线组成），长度限制128B
     * @param string $faceToken - 需要删除的人脸图片token，（由数字、字母、下划线组成）长度限制64B
     * @param array $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     * @return array
     */
    public function faceDelete($userId, $groupId, $faceToken, $options = [])
    {
        return $this->face->faceDelete($userId, $groupId, $faceToken, $options);
    }
    
    /**
     * 用户信息查询接口
     *
     * @param string $userId - 用户id（由数字、字母、下划线组成），长度限制128B
     * @param string $groupId - 用户组id（由数字、字母、下划线组成），长度限制128B
     * @param array $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     * @return array
     */
    public function getUser($userId, $groupId, $options = [])
    {
        return $this->face->getUser($userId, $groupId, $options);
    }
    
    /**
     * 获取用户人脸列表接口
     *
     * @param string $userId - 用户id（由数字、字母、下划线组成），长度限制128B
     * @param string $groupId - 用户组id（由数字、字母、下划线组成），长度限制128B
     * @param array $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     * @return array
     */
    public function faceGetlist($userId, $groupId, $options = [])
    {
        return $this->face->faceGetlist($userId, $groupId, $options);
    }
    
    /**
     * 获取用户列表接口
     *
     * @param string $groupId - 用户组id（由数字、字母、下划线组成），长度限制128B
     * @param array $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     *   start 默认值0，起始序号
     *   length 返回数量，默认值100，最大值1000
     * @return array
     */
    public function getGroupUsers($groupId, $options = [])
    {
        return $this->face->getGroupUsers($groupId, $options);
    }
    
    /**
     * 复制用户接口
     *
     * @param string $userId - 用户id（由数字、字母、下划线组成），长度限制128B
     * @param array $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     *   src_group_id 从指定组里复制信息
     *   dst_group_id 需要添加用户的组id
     * @return array
     */
    public function userCopy($userId, $options = [])
    {
        return $this->face->userCopy($userId, $options);
    }
    
    /**
     * 删除用户接口
     *
     * @param string $groupId - 用户组id（由数字、字母、下划线组成），长度限制128B
     * @param string $userId - 用户id（由数字、字母、下划线组成），长度限制128B
     * @param array $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     * @return array
     */
    public function deleteUser($groupId, $userId, $options = [])
    {
        return $this->face->deleteUser($groupId, $userId, $options);
    }
    
    /**
     * 创建用户组接口
     *
     * @param string $groupId - 用户组id（由数字、字母、下划线组成），长度限制128B
     * @param array $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     * @return array
     */
    public function groupAdd($groupId, $options = [])
    {
        return $this->face->groupAdd($groupId, $options);
    }
    
    /**
     * 删除用户组接口
     *
     * @param string $groupId - 用户组id（由数字、字母、下划线组成），长度限制128B
     * @param array $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     * @return array
     */
    public function groupDelete($groupId, $options = [])
    {
        return $this->face->groupDelete($groupId, $options);
    }
    
    /**
     * 组列表查询接口
     *
     * @param array $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     *   start 默认值0，起始序号
     *   length 返回数量，默认值100，最大值1000
     * @return array
     */
    public function getGroupList($options = [])
    {
        return $this->face->getGroupList($options);
    }
    
    /**
     * 身份验证接口
     *
     * @param string $image - 图片信息(**总数据大小应小于10M**)，图片上传方式根据image_type来判断
     * @param string $imageType - 图片类型 **BASE64**:图片的base64值，base64编码后的图片数据，需urlencode，编码后的图片大小不超过2M；**URL**:图片的 URL地址( 可能由于网络等原因导致下载图片时间过长)**；FACE_TOKEN**: 人脸图片的唯一标识，调用人脸检测接口时，会为每个人脸图片赋予一个唯一的FACE_TOKEN，同一张图片多次检测得到的FACE_TOKEN是同一个
     * @param string $idCardNumber - 身份证号（真实身份证号号码）
     * @param string $name - utf8，姓名（真实姓名，和身份证号匹配）
     * @param array $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     *   quality_control 图片质量控制  **NONE**: 不进行控制 **LOW**:较低的质量要求 **NORMAL**: 一般的质量要求 **HIGH**: 较高的质量要求 **默认 NONE**
     *   liveness_control 活体检测控制  **NONE**: 不进行控制 **LOW**:较低的活体要求(高通过率 低攻击拒绝率) **NORMAL**: 一般的活体要求(平衡的攻击拒绝率, 通过率) **HIGH**: 较高的活体要求(高攻击拒绝率 低通过率) **默认NONE**
     * @return array
     */
    public function personVerify($image, $imageType, $idCardNumber, $name, $options = [])
    {
        return $this->face->personVerify($image, $imageType, $idCardNumber, $name, $options);
    }
    
    /**
     * 语音校验码接口接口
     *
     * @param array $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     *   appid 百度云创建应用时的唯一标识ID
     * @return array
     */
    public function videoSessioncode($options = [])
    {
        return $this->face->videoSessioncode($options);
    }
    
    /**
     * 在线活体检测接口
     *
     * @param array $images
     *
     * @return array
     */
    public function faceverify($images)
    {
        return $this->face->faceverify($images);
    }
    
    /**
     * 人脸比对接口
     *
     * @param array $images
     *
     * @return array
     */
    public function match($images)
    {
        return $this->face->match($images);
    }
    
    /**
     * 人脸比对接口
     *
     * @param array $images
     * @param array $options
     *
     * @return array
     */
    public function merge($images, $options = [])
    {
        return $this->face->merge($images, $options);
    }
}
