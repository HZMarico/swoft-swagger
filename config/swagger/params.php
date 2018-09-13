<?php
/**
 * @SWG\Parameter(name="page",in="query",required=false,type="number",default="1",description="页码"),
 * @SWG\Parameter(name="size",in="query",required=false,type="number",default="10",description="查询长度"),
 * @SWG\Parameter(name="sortBy",in="query",required=false,type="string",default="",description="排序字段"),
 * @SWG\Parameter(name="order",in="query",required=false,type="string",default="",description="排序规则 DESC/ASC"),
 * @SWG\Parameter(name="status",in="query",required=false,type="number",default="",description="状态 1正常0禁用-1删除"),
 * @SWG\Parameter(name="include",in="query",required=false,type="string",default="",description="包含联查模型"),
 * @SWG\Parameter(name="accountId",in="query",required=true,type="number",default="1",description="公众号ID"),
 */